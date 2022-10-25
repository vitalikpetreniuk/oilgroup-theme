<?php
require_once 'FilterTrait.php';
require_once 'FilterRender.php';

class FilterAPI {
	use FilterTrait;

	public function __construct() {
		add_filter( 'pre_get_posts', array( $this, 'pre_get_filter' ) );
		add_action( 'wp_ajax_productfilter', array( $this, 'ajaxItems' ) );
		add_action( 'wp_ajax_nopriv_productfilter', array( $this, 'ajaxItems' ) );
	}

	public function ajaxItems() {
		$vars = unserialize( $_REQUEST['vars'] );
//		$query = new WP_Query();
//        $query->query_vars = unserialize($_REQUEST['vars']);
		$query = new WP_Query(
			array(
				'post_type'   => 'products',
				'product-cat' => $_REQUEST['catid'],
				'paged'       =>$vars->paged,
			)
		);
		ob_start(); ?>
		<?php get_template_part( 'template-parts/content', 'filter' ) ?>
		<?php

		if ( $query->have_posts() ) {
			$c = 0;
			?>
            <div class="col-lg-9">
                <div class="row prod-boxes">
					<?php
					while ( $query->have_posts() ) {
						$c ++;
						$query->the_post();

						get_template_part( 'template-parts/content', 'product', [
							'c' => $c
						] );
					} ?>
                </div>
            </div>
			<?php
		} ?>
		<?php

		?>
        <div class="col-12">
			<?php the_posts_pagination( $query ); ?>
        </div>
		<?php

		$elements = ob_get_clean();

		wp_send_json_success( [ 'data' => $elements ] );
	}
}
