<?php

namespace WPGraphQL\Dokan\Type\Object;

use GraphQL\AppContext;

class VendorType {
    public static function register()
    {
        register_graphql_object_type(
            'Vendor',
            array(
                'description' => __( 'A vendor object', 'wp-graphql-dokan' ),
                'interfaces' => array('Node'),
                'fields' => [
                    'databaseId'            => function() {
                        return $this->ID;
                    },
                    'shop_name' => [
                        'type' => 'String',
                        'description' => __( 'Return the vendor\'s store name', 'wp-graphql-dokan' )
                    ],
                    'shop_url' => [
                        'type' => 'String',
                        'description' => __( 'Return the vendor\'s store url', 'wp-graphql-dokan' )
                    ],
                    'shop_address' => [
                        'type' => 'ShopAddress',
                        'description' => __( 'Return the vendor\'s store address', 'wp-graphql-dokan' )
                    ],
                    'shop_location' => [
                        'type' => 'String',
                        'description' => __( 'Lat/Lang of shop location', 'wp-graphql-dokan' )
                    ],
                    'first' => [
                        'type' => 'String',
                        'description' => __( 'Vendors first name', 'wp-graphql-dokan' )
                    ],
                    'last' => [
                        'type' => 'String',
                        'description' => __( 'Vendors last name', 'wp-graphql-dokan' )
                    ],
                    'email' => [
                        'type' => 'String',
                        'description' => __( 'Vendors email address', 'wp-graphql-dokan' )
                    ],
                    'social' => [
                        'type' => 'DokanSocialAccounts',
                        'description' => __( 'Links to vendors social media accounts', 'wp-graphql-dokan' )
                    ],
                    'phone' => [
                        'type' => 'String',
                        'description' => __( 'Vendors phone number', 'wp-graphql-dokan' )
                    ],
                    'show_email' => [
                        'type' => 'Boolean',
                        'description' => __( 'Show the vendor email on their shop page', 'wp-graphql-dokan' )
                    ],
                    'banner' => [
                        'type' => 'String',
                        'description' => __( 'URL to the store banner', 'wp-graphql-dokan' )
                    ],
                    'banner_id' => [
                        'type' => 'Int',
                        'description' => __( 'Database ID of the store banner', 'wp-graphql-dokan' )
                    ],
                    'avatar' => [
                        'type' => 'String',
                        'description' => __( 'URL to the vendor avatar', 'wp-graphql-dokan' )
                    ],
                    'avatar_id' => [
                        'type' => 'Int',
                        'description' => __( 'Database ID of the vendor avatar', 'wp-graphql-dokan' )
                    ],
                    'products_per_page' => [
                        'type' => 'Int',
                        'description' => __( 'How many products should be shown per page (store page)', 'wp-graphql-dokan' )
                    ],
                    'show_more_product_tab' => [
                        'type' => 'Boolean',
                        'description' => __( 'Should the more products tab be shown on the product listing page', 'wp-graphql-dokan' )
                    ],
                    'toc_enabled' => [
                        'type' => 'Boolean',
                        'description' => __( 'Should the TOC tab be shown', 'wp-graphql-dokan' )
                    ],
                    'store_toc' => [
                        'type' => 'String',
                        'description' => __( 'Shops TOC content', 'wp-graphql-dokan' )
                    ]
                ]
            )
        );


    }
}