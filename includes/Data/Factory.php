<?php

namespace WPGraphQL\Dokan\Data;

use GraphQL\Deferred;
use GraphQL\Type\Definition\ResolveInfo;
use WPGraphQL\AppContext;
use WPGraphQL\Dokan\Data\Connection\VendorConnectionResolver;
use WPGraphQL\Dokan\Model\Vendor;

class Factory {
    public static function resolve_session_vendor()
    {
        return new Vendor();
    }

    /**
     * Returns the Vendor store object for the provided user ID
     *
     * @param int        $id      - user ID of the vendor being retrieved.
     * @param AppContext $context - AppContext object.
     *
     * @return Deferred object
     * @access public
     */
    public static function resolve_vendor( $id, AppContext $context ) {
        if ( empty( $id ) || ! absint( $id ) ) {
            return null;
        }
        $vendor_id = absint( $id );
        $loader      = $context->get_loader( 'dokan_vendor' );
        $loader->buffer( array( $vendor_id ) );
        return new Deferred(
            function () use ( $loader, $vendor_id ) {
                return $loader->load( $vendor_id );
            }
        );
    }

    public static function resolve_vendor_connection($source, array $args, AppContext $context, ResolveInfo $info)
    {

        $resolver = new VendorConnectionResolver( $source, $args, $context, $info );
        return $resolver->get_connection();
    }

    public static function resolve_node( $node, $id, $type, $context ) {
        switch ( $type ) {
            case 'vendor':
                $node = self::resolve_vendor( $id, $context );
                break;
        }

        return $node;
    }

    public static function resolve_node_type($type, $node)
    {
        var_dump('$type');
        die();
        switch ( true ) {
            case is_a( $node, Vendor::class ):
                $type = 'Vendor';
                break;
        }

        return $type;
    }
}