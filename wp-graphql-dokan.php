<?php
/**
 * Plugin Name: WPGraphQL Dokan (DokanGraphQL)
 * Plugin URI: https://github.com/wessex-digital-solutions/wp-graphql-dokan
 * Description: Adds Dokan Functionality to WPGraphQL schema.
 * Version: 0.1.0
 * Author: iamduncan
 * Author URI: https://www.wessexdigitalsolutions.co.uk
 * Text Domain: wp-graphql-dokan
 * Domain Path: /languages
 * License: GPL-3
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 * WC requires at least: 4.0.0
 * WC tested up to: 4.8.0
 * WPGraphQL requires at least: 1.0.0+
 * WPGraphQL-JWT-Authentication requires at least: 0.4.0+
 *
 * @package     WPGraphQL\Dokan
 * @author      iamduncan
 * @license     GPL-3
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

/**
 * Setup WPGraphQL Dokan constants
 */
function dokangraphql_constants()
{
    // Plugin version
    if (!defined('WPGRAPHQL_DOKAN_VERSION')) {
        define('WPGRAPHQL_DOKAN_VERSION', '0.0.1');
    }
    // Plugin folder path
    if (!defined('WPGRAPHQL_DOKAN_PLUGIN_DIR')) {
        define('WPGRAPHQL_DOKAN_PLUGIN_DIR', plugin_dir_path(__FILE__));
    }
    // Plugin folder URL
    if (!defined('WPGRAPHQL_DOKAN_PLUGIN_URL')) {
        define('WPGRAPHQL_DOKAN_PLUGIN_URL', plugin_dir_url(__FILE__));
    }
    // Plugin root file
    if (!defined('WPGRAPHQL_DOKAN_PLUGIN_FILE')) {
        define('WPGRAPHQL_DOKAN_PLUGIN_FILE', __FILE__);
    }
    // Whether to autoload the files
    if (!defined('WPGRAPHQL_DOKAN_AUTOLOAD')) {
        define('WPGRAPHQL_DOKAN_AUTOLOAD', true);
    }
}

/**
 * Checks if WPGraphQL Dokan required plugins are installed and activated
 *
 * @return array
 */
function dokangraphql_dependencies_check()
{
    $deps = array();
    if (!class_exists('\WPGraphQL')) {
        $deps[] = 'WPGraphQL';
    }
    if (!class_exists('\WeDevs_Dokan')) {
        $deps[] = 'Dokan';
    }

    return $deps;
}

function dokangraphql_init()
{
    dokangraphql_constants();

    $not_ready = dokangraphql_dependencies_check();
    if (empty($not_ready)) {
        require_once WPGRAPHQL_DOKAN_PLUGIN_DIR . 'includes/class-wp-graphql-dokan.php';
        return WP_GraphQL_Dokan::instance();
    }

    foreach ($not_ready as $dep) {
        add_action(
            'admin_notices',
            function () use ($dep) {
                ?>
                <div class="error notice">
                    <p>
                        <?php
                        printf(
                        /* translators: dependency not ready error message */
                            esc_html__('%1$s must be active for "WPGraphQL Dokan (DokanGraphQL)" to work', 'wp-graphql-dokan'),
                            esc_html($dep)
                        );
                        ?>
                    </p>
                </div>
                <?php
            }
        );
    }

    return false;
}
add_action( 'graphql_init', 'dokangraphql_init');