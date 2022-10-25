<?php
require_once WP_CONTENT_DIR . '/themes/oilgroup/filter/FilterRender.php';
$brand_cats = get_terms( [ 'taxonomy' => 'brand-cat', 'hide_empty' => false ] );
$filter_render = new FilterRender();
?>
<form class="col-lg-3">
    <div class="choosed-filter">
		<?php $filter_render->parseFilterQuery(); ?>
    </div>
    <div class="filt-btn">
        <img src="<?= get_template_directory_uri() ?>/assets/images/dest/filter.png" alt="">
        <span>
                            <?php esc_html_e( 'Filter', 'oilgroup' ); ?>
                        </span>
    </div>
    <div class="filter">
        <div class="filter-box">
            <div class="title">
                КАТЕГОРІЇ
            </div>
            <ul class="categories">
				<?php foreach ( $brand_cats as $brand_cat ) : ?>
                    <li>
                        <a href="<?= get_term_link( $brand_cat ) ?>"><?= $brand_cat->name ?></a>
                    </li>
				<?php endforeach; ?>
            </ul>
        </div>
		<?php $filter_render->renderAllFilters(); ?>
    </div>
</form>
