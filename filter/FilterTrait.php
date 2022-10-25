<?php
require_once 'FilterTrait.php';

trait FilterTrait {

	public $filter_taxonomies;
	public $filter_postmeta;
	public $tax_query = [];
	public $meta_query = [];

	public function __construct() {
		$this->filter_taxonomies = [
			'api',
			'acea',
			'specifications',
			'viscosity',
			'consistency',
		];

		$this->filter_postmeta = [
			'ground' => __( 'Ground', 'oilgroup' )
		];
	}

	public static function paramsExploded( $str ): array {
		if ( strpos( $str, ',' ) ) {
			return explode( ',', $str );
		}

		return [ $str ];
	}

	function pre_get_filter_postmeta( $postmeta ): array {
		if ( strpos( $_GET[ $postmeta ], ',' ) ) {
			return array(
				'key'     => $postmeta,
				'value'   => explode( ',', sanitize_text_field( $_GET[ $postmeta ] ) ),
				'compare' => 'IN',
			);
		}

		return array(
			'key'     => $postmeta,
			'value'   => sanitize_text_field( $_GET[ $postmeta ] ),
			'compare' => '==',
		);
	}

	function get_acf_key( $field_name ) {
		$field_name = '_' . $field_name;
		global $wpdb;
		$sql = "SELECT `meta_value` FROM `wp_postmeta` WHERE meta_key = '" . $field_name . "'";

		return $wpdb->get_var( $sql );
	}

	function count_posts_acf( $post_type, $field_name, $value ): int {
		$args  = [
			'post_type'      => $post_type,
			'posts_per_page' => - 1,
			'meta_query'     => [
				[
					'key'     => $field_name,
					'value'   => $value,
					'compare' => '='
				]
			]
		];
		$query = new WP_Query( $args );

		return $query->post_count;

	}

	function count_posts( $auto_args, $field_name, $value ): int {
		$new_meta_query = [];
		foreach ( $auto_args['meta_query'] as $arg ) {
			if ( $field_name == 'brand' && $arg['key'] == 'model' ) {
				continue;
			}
			if ( $arg['key'] != $field_name ) {
				$new_meta_query[] = $arg;
			}
		}
		$new_meta_query[]        = [
			'key'     => $field_name,
			'value'   => $value,
			'compare' => '='
		];
		$auto_args['meta_query'] = $new_meta_query;
		$query                   = new WP_Query( $auto_args );

		return $query->post_count;
	}

	function combine_arr( $a, $b ) {
		$acount = count( $a );
		$bcount = count( $b );
		$size   = ( $acount > $bcount ) ? $bcount : $acount;
		$a      = array_slice( $a, 0, $size );
		$b      = array_slice( $b, 0, $size );

		return array_combine( $a, $b );
	}

	/**
	 * @param WP_Query $query
	 *
	 * @return WP_Query
	 */
	function pre_get_filter( $query ) {
		if ( ( $query->is_main_query() && $query->is_tax( 'product-cat' ) ) || $query->get( 'product-cat' ) ) {
			$cat = $query->get( 'product-cat' );

//			$this->tax_query[] = [
//				'taxonomy' => 'product-cat',
//				'terms'    => $cat,
//			];

			if ( $query->is_tax( 'product-cat' ) ) {

			} else {
				$query->set( 'product-cat', null );
				$this->tax_query[] = [
					'taxonomy' => 'product-cat',
					'terms'    => $cat,
				];
			}

			if ( isset( $_REQUEST['ground'] ) ) {
				array_push( $this->meta_query, $this->pre_get_filter_postmeta( 'ground' ) );
			}

			if ( wp_doing_ajax() ) {
				if ( isset( $_REQUEST['brand-cat'] ) ) {
					$this->tax_query[] = [
						'taxonomy' => 'brand-cat',
						'field'    => 'slug',
						'terms'    => $this->paramsExploded( $_REQUEST['brand-cat'] )
					];
				}

				if ( isset( $_REQUEST['specifications'] ) ) {
					$this->tax_query[] = [
						'taxonomy' => 'specifications',
						'field'    => 'slug',
						'terms'    => $this->paramsExploded( $_REQUEST['specifications'] )
					];
				}

				if ( isset( $_REQUEST['viscosity'] ) ) {
					$this->tax_query[] = [
						'taxonomy' => 'viscosity',
						'field'    => 'slug',
						'terms'    => $this->paramsExploded( $_REQUEST['viscosity'] )
					];
				}

				if ( isset( $_REQUEST['consistency'] ) ) {
					$this->tax_query[] = [
						'taxonomy' => 'consistency',
						'field'    => 'slug',
						'terms'    => $this->paramsExploded( $_REQUEST['consistency'] )
					];
				}

				if ( isset( $_REQUEST['api'] ) ) {
					$this->tax_query[] = [
						'taxonomy' => 'api',
						'field'    => 'slug',
						'terms'    => $this->paramsExploded( $_REQUEST['api'] )
					];
				}

				if ( isset( $_REQUEST['acea'] ) ) {
					$this->tax_query[] = [
						'taxonomy' => 'acea',
						'field'    => 'slug',
						'terms'    => $this->paramsExploded( $_REQUEST['acea'] )
					];
				}

				if ( count( $this->tax_query ) ) {
					$this->tax_query['relation'] = 'AND';
//					var_dump($this->tax_query);
					$query->set( 'tax_query', $this->tax_query );
				}

//				var_dump($this->tax_query);
//				var_dump($query->found_posts);
			}
//			var_dump( $this->meta_query );
			if ( count( $this->meta_query ) ) {
				$this->meta_query['relation'] = 'AND';

				$query->set( 'meta_query', $this->meta_query );
			}
		}

		return $query;
	}
}
