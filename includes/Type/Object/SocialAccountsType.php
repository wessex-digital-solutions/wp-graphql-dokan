<?php
/**
 * wp-graphql-dokan.
 * User: Duncan
 * Date: 29/12/2020
 * Time: 13:58
 */

namespace WPGraphQL\Dokan\Type\Object;


class SocialAccountsType
{
    public static function register()
    {
        register_graphql_object_type(
            'DokanSocialAccounts',
            [
                'description' => __( 'A dokan social media object', 'wp-graphql-dokan' ),
                'fields' => [
                    'facebook' => [
                        'type' => 'String',
                        'description' => __( 'Link to Facebook', 'wp-graphql-dokan' ),
                        'resolve' => function( $socials ) {
                            return ! empty( $socials['fb'] ) ? $socials['fb'] : null;
                        }
                    ],
                    'twitter' => [
                        'type' => 'String',
                        'description' => __( 'Link to Twitter', 'wp-graphql-dokan' ),
                        'resolve' => function( $socials ) {
                            return ! empty( $socials['twitter'] ) ? $socials['twitter'] : null;
                        }
                    ],
                    'pinterest' => [
                        'type' => 'String',
                        'description' => __( 'Link to Pinterest', 'wp-graphql-dokan' ),
                        'resolve' => function( $socials ) {
                            return ! empty( $socials['pinterest'] ) ? $socials['pinterest'] : null;
                        }
                    ],
                    'linkedin' => [
                        'type' => 'String',
                        'description' => __( 'Link to LinkedIn', 'wp-graphql-dokan' ),
                        'resolve' => function( $socials ) {
                            return ! empty( $socials['linkedin'] ) ? $socials['linkedin'] : null;
                        }
                    ],
                    'youtube' => [
                        'type' => 'String',
                        'description' => __( 'Link to YouTube', 'wp-graphql-dokan' ),
                        'resolve' => function( $socials ) {
                            return ! empty( $socials['youtube'] ) ? $socials['youtube'] : null;
                        }
                    ],
                    'instagram' => [
                        'type' => 'String',
                        'description' => __( 'Link to Instagram', 'wp-graphql-dokan' ),
                        'resolve' => function( $socials ) {
                            return ! empty( $socials['instagram'] ) ? $socials['instagram'] : null;
                        }
                    ],
                    'flickr' => [
                        'type' => 'String',
                        'description' => __( 'Link to Flickr', 'wp-graphql-dokan' ),
                        'resolve' => function( $socials ) {
                            return ! empty( $socials['flickr'] ) ? $socials['flicke'] : null;
                        }
                    ]
                ]
            ]
        );
    }
}