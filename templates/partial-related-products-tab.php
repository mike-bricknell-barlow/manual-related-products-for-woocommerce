<div id="related_product_data" class="panel woocommerce_options_panel hidden">
    <div class="options_group">
        <p class="form-field">
			<label for="related_product_ids"><?php esc_html_e( 'Related products', 'woocommerce' ); ?></label>
			<select class="wc-product-search" multiple="multiple" style="width: 50%;" id="related_product_ids" name="related_product_ids[]" data-placeholder="<?php esc_attr_e( 'Search for a product&hellip;', 'woocommerce' ); ?>" data-action="woocommerce_json_search_products" data-exclude="<?php echo intval( $post->ID ); ?>">
				<?php
				foreach ( $related_product_ids as $product_id ) {
					$product = wc_get_product( $product_id );
					if ( is_object( $product ) ) {
						echo '<option value="' . esc_attr( $product_id ) . '"' . selected( true, true, false ) . '>' . wp_kses_post( $product->get_formatted_name() ) . '</option>';
					}
				}
				?>
			</select> <?php echo wc_help_tip( __( 'Related products are those that are similar to the currently viewed product.', 'woocommerce' ) ); // WPCS: XSS ok. ?>
		</p>
    </div>
</div>