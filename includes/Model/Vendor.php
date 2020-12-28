<?php
/**
 * wp-graphql-dokan.
 * User: Duncan
 * Date: 28/12/2020
 * Time: 16:50
 */

namespace WPGraphQL\Dokan\Model;

use GraphQLRelay\Relay;
use WPGraphQL\Model\Model;

class Vendor extends Model
{

    /**
     * Vendor constructor.
     */
    public function __construct( $id = 'session' )
    {
        $this->data = 'session' === $id ? \dokan()->vendor : new \WeDevs\Dokan\Vendor\Vendor( $id );

        $allowed_restricted_fields = array(
            'isRestricted',
            'isPrivate',
            'isPublic',
            'id',
            'vendorId',
        );

        // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound
        $restricted_cap = apply_filters( 'vendor_restricted_cap', 'session' === $id ? '' : 'list_users' );

        parent::__construct( $restricted_cap, $allowed_restricted_fields, $id );
    }

    public function __call($method, $args)
    {
        return $this->data->$method( ...$args );
    }

    protected function init()
    {
        if ( empty( $this->fields ) ) {
            $this->fields = array(
                'id' => function() {
                    return ! is_null( $this->data->get_id() ) ? $this->data->get_id() : null;
                },
                'shop_name' => function() {
                    return ! is_null( $this->data->get_shop_name() ) ? $this->data->get_shop_name() : null;
                },
                'shop_url' => function() {
                    return ! is_null( $this->data->get_shop_url() ) ? $this->data->get_shop_url() : null;
                }
            );
        }

        parent::prepare_fields();
    }


}