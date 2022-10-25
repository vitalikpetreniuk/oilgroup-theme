<?php
/**
 * Widget API: WP_Widget_ProductCats class
 *
 * @package WordPress
 * @subpackage Widgets
 * @since 4.4.0
 */

/**
 * Core class used to implement a Menu Categories widget.
 *
 * @since 2.8.0
 *
 * @see WP_Widget
 */
class WP_Widget_ProductCats extends WP_Widget {

	/**
	 * Sets up a new Menu Categories widget instance.
	 *
	 * @since 2.8.0
	 */
	public function __construct() {
		$widget_ops = array(
			'classname'                   => 'widget_productcats_entries',
			'description'                 => __( 'Your site&#8217;s menu categories.' ),
			'customize_selective_refresh' => true,
		);
		parent::__construct( 'productcats-posts', __( 'Product Categories Carts' ), $widget_ops );
		$this->alt_option_name = 'widget_productcats_entries';
	}

	/**
	 * Outputs the content for the current Menu Categories widget instance.
	 *
	 * @param array $args Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current Menu Categories widget instance.
	 *
	 * @since 2.8.0
	 *
	 */
	public function widget( $args, $instance ) {

		$catsid = ! empty( $instance['catsid'] ) ? $instance['catsid'] : '';

		$catsidarr = explode(',', $catsid);

		$cats = [];

		foreach ($catsidarr as $carts=>$val) {
			array_push($cats, (int) $val);
        }

		$menucats = get_terms( array(
			'taxonomy'   => 'product_tag',
			'hide_empty' => false,
			'number'     => 5,
            'include'    => $cats,
		) );
		?>
        <div class="header-dishes fivecats-blocks">
	        <?php foreach ( $menucats as $mcat ) {
	            $link = get_term_link($mcat->term_id, $mcat->taxonomy);
	            $img = get_term_meta($mcat->term_id, 'product_search_image_id', true); ?>
                <div class="dish-card">
                    <a href="<?= $link ?>">
                        <img src="<?= wp_get_attachment_url($img, 'full'); ?>" alt="<?= $mcat->name ?>">
                    </a>
                    <a href="<?= $link ?>" class="btn btn-white"><?= $mcat->name; ?></a>
                </div>

	        <?php } ?>
        </div>
		<?php
	}

	/**
	 * Handles updating the settings for the current Menu Categories widget instance.
	 *
	 * @param array $new_instance New settings for this instance as input by the user via
	 *                            WP_Widget::form().
	 * @param array $old_instance Old settings for this instance.
	 *
	 * @return array Updated settings to save.
	 * @since 2.8.0
	 *
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		if ( ! empty( $new_instance['catsid'] ) ) {
			$instance['catsid'] = sanitize_text_field( $new_instance['catsid'] );
		}
		return $instance;
	}

	/**
	 * Outputs the settings form for the Menu Categories widget.
	 *
	 * @param array $instance Current settings.
	 *
	 * @since 2.8.0
	 *
	 */
	public function form( $instance ) {
	    $catsid = isset( $instance['catsid'] ) ? $instance['catsid'] : '';
		?>
        <p>
            <label for="<?php echo $this->get_field_id( 'catsid' ); ?>"><?php _e( 'List of ids:' ) ?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'catsid' ); ?>" name="<?php echo $this->get_field_name( 'catsid' ); ?>" value="<?php echo esc_attr( $catsid ); ?>"/>
        </p>
		<?php
	}
}

add_action( 'widgets_init', 'productcats_register_widgets' );
function productcats_register_widgets() {
	register_widget( 'WP_Widget_ProductCats' );
}
