<div class="news-block">
    <a href="<?php the_permalink(); ?>">
		<?php the_post_thumbnail(); ?>
        <div class="title"><?php the_title(); ?></div>
    </a>
	<?php the_excerpt(); ?>
    <a href="<?php the_permalink(); ?>" class="more"><?php esc_html_e( 'Read more', 'oilgroup' ); ?></a>
</div>
