<?php
/**
 * wp-graphql-dokan.
 * User: Duncan
 * Date: 29/12/2020
 * Time: 12:36
 */

namespace WPGraphQL\Dokan\Type\Object;


class ShopAddressType
{
    public static function register()
    {
        register_graphql_object_type(
            'ShopAddress',
            [
                'description' => __('A shop address object', 'wp-graphql-dokan'),
                'fields' => [
                    'address1' => [
                        'type' => 'String',
                        'description' => __( 'Address1', 'wp-graphql-dokan' ),
                        'resolve' => function( $address ) {
                            return ! empty( $address['street_1' ] ) ? $address['street_1'] : null;
                        }
                    ],
                    'address2' => [
                        'type' => 'String',
                        'description' => __( 'Address 2', 'wp-graphql-dokan' ),
                        'resolve' => function( $address ) {
                            return ! empty( $address['street_2'] ) ? $address['street_2'] : null;
                        }
                    ],
                    'city' => [
                        'type' => 'String',
                        'description' => __( 'City', 'wp-graphql-dokan' ),
                        'resolve' => function( $address ) {
                            return ! empty( $address['city'] ) ? $address['city'] : null;
                        }
                    ],
                    'postcode' => [
                        'type' => 'String',
                        'description' => __( 'Postcode', 'wp-graphql-dokan' ),
                        'resolve' => function( $address ) {
                            return ! empty( $address['zip'] ) ? $address['zip'] : null;
                        }
                    ],
                    'county' => [
                        'type' => 'String',
                        'description' => __( 'County/State', 'wp-graphql-dokan' ),
                        'resolve' => function( $address ) {
                            return ! empty( $address['state'] ) ? $address['state'] : null;
                        }
                    ],
                    'country' => [
                        'type' => 'String',
                        'description' => __( 'Country (code)', 'wp-graphql-dokan' ),
                        'resolve' => function( $address ) {
                            return ! empty( $address['country'] ) ? $address['country'] : null;
                        }
                    ]
                ]
            ]
        );
    }
}