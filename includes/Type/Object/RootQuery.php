<?php
/**
 * wp-graphql-dokan.
 * User: Duncan
 * Date: 28/12/2020
 * Time: 19:30
 */

namespace WPGraphQL\Dokan\Type\Object;

use GraphQL\Error\UserError;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQLRelay\Relay;
use WPGraphQL\AppContext;
use WPGraphQL\Dokan\Data\Factory;

class RootQuery
{
    public static function register_fields()
    {
        register_graphql_fields(
            'RootQuery',
            [
                'vendor' => [
                    'type' => 'Vendor',
                    'description' => __( 'A vendor object', 'wp-graphql-dokan' ),
                    'args' => [
                        'id' => [
                            'type' => 'ID',
                            'description' => __('Get the vendor by their global ID', 'wp-graphql-dokan')
                        ],
                        'vendorId' => [
                            'type' => 'Int',
                            'description' => __('Get the vendor by their database ID', 'wp-graphql-dokan')
                        ]
                    ],
                    'resolve' => function ( $source, array $args, AppContext $context ) {
                        $vendor_id = 0;
                        if ( ! empty( $args['id'] ) ) {
                            $id_components = Relay::fromGlobalId( $args['id'] );
                            if ( ! isset( $id_components['id'] ) || ! absint( $id_components['id'] ) ) {
                                throw new UserError( __( 'The ID input is invalid', 'wp-graphql-dokan' ) );
                            }

                            $vendor_id = absint( $id_components['id'] );
                        } elseif ( ! empty( $args['vendorId'] ) ) {
                            $vendor_id = absint( $args['vendorId'] );
                        }

                        $authorized = ! empty( $vendor_id )
                            && ! current_user_can( 'list_users' )
                            && get_current_user_id() !== $vendor_id;
                        if ( $authorized ) {
                            throw new UserError( __( 'Not authorized to access this vendor', 'wp-graphql-dokan' ) );
                        }

                        if ( $vendor_id ) {
                            return Factory::resolve_vendor( $vendor_id, $context );
                        }

                        return Factory::resolve_session_vendor();
                    }
                ]
            ]
        );
    }
}