<?php
/**
 * wp-graphql-dokan.
 * User: Duncan
 * Date: 28/12/2020
 * Time: 17:37
 */

namespace WPGraphQL\Dokan;

class TypeRegistry {

    public function init()
    {
        // Objects
        \WPGraphQL\Dokan\Type\Object\VendorType::register();

        // Object fields
        \WPGraphQL\Dokan\Type\Object\RootQuery::register_fields();

        // Connections
        \WPGraphQL\Dokan\Connection\Vendors::register_connections();
    }
}