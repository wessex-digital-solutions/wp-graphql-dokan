<?php
/**
 * wp-graphql-dokan.
 * User: Duncan
 * Date: 28/12/2020
 * Time: 20:26
 */

namespace WPGraphQL\Dokan;

use WPGraphQL\Dokan\Data\Factory;
use WPGraphQL\Dokan\Data\Loader\DokanVendorLoader;

class CoreSchemaFilters
{
    public static function add_filters()
    {
        // Add data-loaders to AppContext.
        add_filter( 'graphql_data_loaders', array( __CLASS__, 'graphql_data_loaders' ), 10, 2 );

        // Add node resolvers.
        add_filter(
            'graphql_resolve_node',
            array( '\WPGraphQL\WooCommerce\Data\Factory', 'resolve_node' ),
            10,
            4
        );
        add_filter(
            'graphql_resolve_node_type',
            array( '\WPGraphQL\WooCommerce\Data\Factory', 'resolve_node_type' ),
            10,
            2
        );
    }

    public static function graphql_data_loaders($loaders, $context)
    {
        $vendor_loader = new DokanVendorLoader( $context );
        $loaders['dokan_vendor'] = &$vendor_loader;

        return $loaders;
    }
}