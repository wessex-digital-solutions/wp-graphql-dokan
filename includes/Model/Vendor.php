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
                },
                'shop_address' => function() {
                    return ! is_null( $this->data->get_address() ) ? $this->data->get_address() : null;
                },
                'shop_location' => function() {
                    return ! is_null( $this->data->get_location() ) ? $this->data->get_location() : null;
                },
                'social' => function() {
                    return ! is_null( $this->data->get_social_profiles() ) ? $this->data->get_social_profiles() : null;
                },
                'first' => function() {
                    return ! is_null( $this->data->get_first_name() ) ? $this->data->get_first_name() : null;
                },
                'last' => function() {
                    return ! is_null( $this->data->get_last_name() ) ? $this->data->get_last_name() : null;
                },
                'phone' => function() {
                    return ! is_null( $this->data->get_phone() ) ? $this->data->get_phone() : null;
                },
                'email' => function() {
                    return ! is_null( $this->data->get_email() ) ? $this->data->get_email() : null;
                },
                'show_email' => function() {
                    return ! is_null( $this->data->show_email() ) ? $this->data->show_email() : null;
                },
                'banner' => function() {
                    return ! is_null( $this->data->get_banner() ) ? $this->data->get_banner() : null;
                },
                'banner_id' => function() {
                    return ! is_null( $this->data->get_banner_id() ) ? $this->data->get_banner_id() : null;
                },
                'avatar' => function() {
                    return ! is_null( $this->data->get_avatar() ) ? $this->data->get_avatar() : null;
                },
                'avatar_id' => function() {
                    return ! is_null( $this->data->get_avatar_id() ) ? $this->data->get_avatar_id() : null;
                }
            );
        }

        parent::prepare_fields();
    }


}