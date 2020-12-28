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
                    ]
                ]
            )
        );


    }
}