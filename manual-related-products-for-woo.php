<?php
/**
 * Plugin Name:       Manual Related Products for WooCommerce
 * Plugin URI:        
 * Description:       Allows you to choose a manual set of products for display under the Related Products section on WooCommerce single product pages.
 * Version:           1.0.2
 * Requires at least: 5.0.0
 * Requires PHP:      7.0
 * Author:            Mike Bricknell-Barlow
 * Author URI:        https://bricknellbarlow.co.uk
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       manual-related-products-for-woo
*/

define( 'MANUAL_RELATED_PRODUCTS_WOOCOMMERCE_VERSION', '1.0.2' );
define( 'MANUAL_RELATED_PRODUCTS_WOOCOMMERCE_PLUGIN_DIR_URL', plugin_dir_url( __FILE__ ) );
define( 'MANUAL_RELATED_PRODUCTS_WOOCOMMERCE_PLUGIN_DIR_PATH', dirname( __FILE__ ) );

require_once 'classes' . DIRECTORY_SEPARATOR . 'class-manual-related-products-for-woocommerce.php';

global $manual_related_products;
$manual_related_products = new Manual_Related_Products_For_WooCommerce();
