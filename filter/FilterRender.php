<?php

class FilterRender {
	use FilterTrait;

	public function filterTaxonomy( $filter_key, $title ) {
		wp_reset_query();
		global $post;

		$terms = get_terms( array(
			'taxonomy'   => $filter_key,
			'hide_empty' => false
		) );

//		$query = new WP_Query(array(
//			'meta_query'  => $this->meta_query,
//			'tax_query' => $this->tax_query,
//		));
//		if (!$query->post_count) return;

		$active_values = explode( ',', $_GET[ $filter_key ] );
		?>
        <div class="filter-box">
            <div class="title">
				<?= $title ?>
            </div>
            <div class="check-wrapper">
				<?php foreach ( $terms as $item ) : ?>
                    <label for="<?= $item->slug ?>">
                        <div class="check-inn">
                            <input id="<?= $item->slug ?>"
                                   value="<?= $item->slug ?>" <?php if ( array_search( $item->slug, $active_values ) !== false ) {
								echo "checked";
							} ?> name="<?= $filter_key ?>" type="checkbox">
                            <span></span>
                        </div>
                        <span><?= $item->name ?></span>
                    </label>
				<?php endforeach; ?>
            </div>
        </div>

		<?php
	}

	public function filterTaxonomyTree( $filter_key ) {
		wp_reset_query();
		global $post;

		$parentterms = get_terms( array(
			'taxonomy'   => $filter_key,
			'parent'     => 0,
			'hide_empty' => false
		) );

		$active_values = explode( ',', $_GET[ $filter_key ] );

//        $query = new WP_Query(array(
//			'meta_query'  => $this->meta_query,
//			'tax_query' => $this->tax_query,
//		));
//		if (!$query->post_count) return;

		foreach ( $parentterms as $parentterm ) {
			?>
            <div class="filter-box">
                <div class="title">
					<?= $parentterm->name ?>
                </div>
                <div class="check-wrapper">
					<?php
					$subterms = get_terms(
						array(
							'taxonomy'   => $filter_key,
							'parent'     => $parentterm->term_id,
							'hide_empty' => false,
							'count'      => true,
						)
					);
					foreach ( $subterms as $item ) : ?>
                        <label for="<?= $item->slug ?>">
                            <div class="check-inn">
                                <input id="<?= $item->slug ?>"
                                       value="<?= $item->slug ?>" <?php if ( array_search( $item->slug, $active_values ) !== false ) {
									echo "checked";
								} ?> name="<?= $filter_key ?>" type="checkbox">
                                <span></span>
                            </div>
                            <span><?= $item->name ?></span>
                        </label>
					<?php endforeach; ?>
                </div>
            </div>

			<?php
		}
	}

	public function filterPostmeta( $filter_key, $title ) {
		wp_reset_query();

		$items = get_field_object( $this->get_acf_key( $filter_key ) )['choices'];

		$active_values = explode( ',', $_GET[ $filter_key ] );
//        $query = new WP_Query(array(
//           'meta_query'  => $this->meta_query,
//           'tax_query' => $this->tax_query,
//        ));
//        if (!$query->post_count) return;
		?>
        <div class="filter-box">
            <div class="title">
				<?= $title ?>
            </div>
            <div class="check-wrapper">
				<?php if ( is_array( $items ) ) : ?>
					<?php foreach ( $items as $key => $item ) : ?>
                        <label for="<?= $key ?>">
                            <div class="check-inn">
                                <input id="<?= $key ?>"
                                       value="<?= $key ?>" <?php if ( array_search( $key, $active_values ) !== false ) {
									echo "checked";
								} ?> name="<?= $filter_key ?>" type="checkbox">
                                <span></span>
                            </div>
                            <span><?= $item ?></span>
                        </label>
					<?php endforeach; ?>
				<?php endif; ?>
            </div>
        </div>

		<?php
	}

	public function parseFilterQuery() {
		foreach ( $_GET as $key => $param ) {
			if ( array_search( $key, $this->filter_taxonomies ) !== false ) {
				if ( ! ( $tax = get_taxonomy( $key ) ) ) {
					continue;
				}
				?>
                <b><?= $tax->labels->name; ?></b>
				<?php foreach ( $this->paramsExploded( $param ) as $catid ) {
					$term = get_term( $catid, $key );
					if ( ! $term ) {
						continue;
					}
					?>
                    <span data-key="<?= $key ?>" data-value="<?= $catid ?>"><?= $term->name; ?></span>
				<?php } ?>
				<?php
			} else if ( isset( $this->filter_postmeta[ $key ] ) ) {
				$items = get_field_object( $this->get_acf_key( $key ) )['choices']; ?>
                <b><?= $this->filter_postmeta[ $key ]; ?></b>
				<?php foreach ( $this->combine_arr( $this->paramsExploded( $param ), $items ) as $item ) {
					?>
                    <span data-key="<?= $key ?>" data-value="<?= $catid ?>"><?= $item ?></span>
					<?php
				}
			}
		}
	}

	public function renderAllFilters() {
		$this->filterPostmeta( 'ground', __( 'Ground', 'oilgroup' ) );
		$this->filterTaxonomy( 'viscosity', __( 'Viscosity', 'oilgroup' ) );
		$this->filterTaxonomy( 'consistency', __( 'Consistency', 'oilgroup' ) );
		$this->filterTaxonomy( 'api', __( 'API', 'oilgroup' ) );
		$this->filterTaxonomy( 'acea', __( 'ACEA', 'oilgroup' ) );
		$this->filterTaxonomyTree( 'specifications' );
	}
}
