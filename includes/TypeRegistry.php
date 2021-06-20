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
        \WPGraphQL\Dokan\Type\Object\ShopAddressType::register();
        \WPGraphQL\Dokan\Type\Object\SocialAccountsType::register();

        // Object fields
        \WPGraphQL\Dokan\Type\Object\RootQuery::register_fields();

        // Connections
        \WPGraphQL\Dokan\Connection\Vendors::register_connections();
    }
}