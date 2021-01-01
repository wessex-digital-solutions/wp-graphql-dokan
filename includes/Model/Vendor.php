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

        $this->commission = new \WeDevs\Dokan\Commission();

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
                },
                'products_per_page' => function() {
                    return ! is_null( $this->data->get_per_page() ) ? $this->data->get_per_page() : null;
                },
                'show_more_products_tab' => function() {
                    return  ! is_null( $this->data->show_more_products_tab() ) ? $this->data->show_more_products_tab() : null;
                },
                'toc_enabled' => function() {
                    return ! is_null( $this->data->toc_enabled() ) ? $this->data->toc_enabled() : null;
                },
                'store_toc' => function() {
                    return ! is_null( $this->data->get_toc() ) ? $this->data->get_toc() : null;
                },
                'featured' => function() {
                    return ! is_null( $this->data->is_featured() ) ? $this->data->is_featured() : null;
                },
                'rating' => function() {
                    return ! is_null( $this->data->get_rating() ) ? $this->data->get_rating() : null;
                },
                'payment' => function() {
                    return ! is_null( $this->data->get_payment_profiles() ) ? $this->data->get_payment_profiles() : null;
                },
                'trusted' => function() {
                    return ! is_null( $this->data->is_trusted() ) ? $this->data->is_trusted() : null;
                },
                'store_open_close' => function() {
                    return $this->store_open_close();
                },
                'vendor_commission_type' => function() {
                    return ! is_null( $this->commission->get_vendor_wise_type( $this->data->get_id() ) ) ? $this->commission->get_vendor_wise_type( $this->data->get_id() ) : null;
                },
                'vendor_commission_rate' => function() {
                    return ! is_null( $this->commission->get_vendor_wise_rate( $this->data->get_id() ) ) ? $this->commission->get_vendor_wise_rate( $this->data->get_id() ) : null;
                }
            );
        }

        parent::prepare_fields();
    }

    private function store_open_close()
    {
        $timeEnabled = $this->data->is_store_time_enabled();
        if ($timeEnabled) {
            return [
                'time' => ! is_null( $this->data->get_store_time() ) ? $this->data->get_store_time() : null,
                'open_notice' => ! is_null(  $this->data->get_store_open_notice() ) ? $this->data->get_store_open_notice() : null,
                'closed_notice' => ! is_null( $this->data->get_store_close_notice() ) ? $this->data->get_store_close_notice() : null
            ];
        }
        return null;
    }


}