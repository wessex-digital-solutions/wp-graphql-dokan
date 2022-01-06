<?php
/**
 * Initialise a singleton instance of WP_GraphQL_Dokan
 * 
 * @package WPGraphQL\Dokan
 * @since 0.0.1
 */

// exit id accessed directly
defined('ABSPATH') || exit;

if (! class_exists('WP_GraphQL_Dokan')) :


    /**
     * Class QP_GraphQL_Dokan
     */
    final class WP_GraphQL_Dokan {
        /**
         * Stores the instance of the WP_GraphQL_WooCommerce class
         *
         * @var WP_GraphQL_Dokan The one true WP_GraphQL_WooCommerce
         */
        private static $instance;

        public static function instance() {
            if ( ! isset( self::$instance ) && ! ( is_a( self::$instance, __CLASS__ ) ) ) {
                self::$instance = new self();
                self::$instance->includes();
                self::$instance->setup();
            }

            /**
             * Fire off init action
             *
             * @param WP_GraphQL_Dokan $instance The instance of the WP_GraphQL_WooCommerce class
             */
            do_action( 'graphql_woocommerce_init', self::$instance );

            // Return the WPGraphQLWooCommerce Instance.
            return self::$instance;
        }

        public static function get_post_types()
        {
            return apply_filters(
                'graphql_dokan_post_types',
                [
                    'vendor'
                ]
            );
        }

        /**
         * Throw error on object clone.
         */
        public function __clone()
        {
            _doing_it_wrong(__FUNCTION__, esc_html__('WP_GraphQL_Dokan class should not be cloned.', 'wp-graphql-dokan'), '0.0.1');
        }

        public function _wakeup()
        {
            _doing_it_wrong(__FUNCTION__, esc_html( 'De-serializing instances of the WP_GraphQL_Dokan class is not allowed.', 'wp-graphql-dokan' ), '0.0.1');
        }

        /**
         * Include required files.
         * Uses composer's autoload
         *
         * @since  0.0.1
         */
        private function includes() {

            // Autoload Required Classes.
            if ( defined( 'WPGRAPHQL_DOKAN_AUTOLOAD' ) && false !== WPGRAPHQL_DOKAN_AUTOLOAD ) {
                require_once WPGRAPHQL_DOKAN_PLUGIN_DIR . 'vendor/autoload.php';
            }

            // Required non-autoloaded classes.
//            require_once WPGRAPHQL_DOKAN_PLUGIN_DIR . 'access-functions.php';
//            require_once WPGRAPHQL_DOKAN_PLUGIN_DIR . 'class-inflect.php';
        }

        /**
         * Sets up WooGraphQL schema.
         */
        private function setup() {
            // Setup minor integrations.
//            \WPGraphQL\Dokan\Functions\setup_minor_integrations();

            // Register WooCommerce filters.
//            \WPGraphQL\Dokan\WooCommerce_Filters::setup();

            // Register WPGraphQL core filters.
            \WPGraphQL\Dokan\CoreSchemaFilters::add_filters();

            // Register WPGraphQL ACF filters.
//            \WPGraphQL\Dokan\ACF_Schema_Filters::add_filters();

            // Register WPGraphQL JWT Authentication filters.
//            \WPGraphQL\Dokan\JWT_Auth_Schema_Filters::add_filters();

            // Initialize Dokan TypeRegistry.
            $registry = new \WPGraphQL\Dokan\TypeRegistry();
            add_action( 'graphql_register_types', array( $registry, 'init' ), 10, 1 );
        }
    }
    
endif;