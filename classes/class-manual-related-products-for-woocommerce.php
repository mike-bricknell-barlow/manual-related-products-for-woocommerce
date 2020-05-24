<?php

class Manual_Related_Products_For_WooCommerce {
    function __construct() {
        $this->actions_and_filters();
    }

    private function actions_and_filters() {
        add_filter( 'woocommerce_product_data_tabs', array( $this, 'add_tab_to_single_product_admin_screen' ) );
        add_filter( 'woocommerce_related_products', array( $this, 'output_manual_related_products' ) );

        add_action( 'woocommerce_product_data_panels', array( $this, 'related_products_tab_template' ) );
        add_action( 'save_post', array( $this, 'save_related_products_on_product_update' ), 10, 2 );
    }

    public function add_tab_to_single_product_admin_screen( $data_tabs ) {
        $related_products_tab = array (
            'related_products' => array (
                'label'    => __( 'Related Products', 'woocommerce' ),
                'target'   => 'related_product_data',
                'class'    => array(),
                'priority' => 45,
            ),
        );

        $data_tabs = array_merge( $data_tabs, $related_products_tab );
        return $data_tabs;
    }

    public function related_products_tab_template() {
        $related_product_ids = $this->get_related_product_ids_for_current_product();
        include MANUAL_RELATED_PRODUCTS_WOOCOMMERCE_PLUGIN_DIR_PATH . '/templates/partial-related-products-tab.php';
    }

    public function save_related_products_on_product_update( $post_ID, $post ) {
        if( get_post_type( $post ) == 'product' ) {
            $related_product_ids = array();

            if( isset( $_POST['related_product_ids'] ) ) {
                // Santize POST data - only numeric strings allowed
                $related_product_ids = array_filter( $_POST['related_product_ids'], 'ctype_digit' );
            }
            
            update_post_meta( $post_ID, 'related_product_ids', $related_product_ids );
        }
    }

    public function get_related_product_ids_for_current_product() {
        // Santize data - only numeric strings allowed
        $related_product_ids = array_filter( get_post_meta( get_the_id(), 'related_product_ids', true ), 'ctype_digit' );
        return $related_product_ids;
    }

    public function output_manual_related_products( $related_posts ) {
        $new_related_posts = $this->get_related_product_ids_for_current_product();

        if( empty( $new_related_posts ) ) {
            return $related_posts;
        }

        if ( apply_filters( 'woocommerce_product_related_posts_shuffle', true ) ) {
            shuffle( $related_posts );
        }

        $related_posts = array_merge( $new_related_posts, $related_posts );
        $related_posts = array_unique( $related_posts );
        $related_posts = array_slice( $related_posts, 0, 4 );
        
        return $related_posts;
    }
}