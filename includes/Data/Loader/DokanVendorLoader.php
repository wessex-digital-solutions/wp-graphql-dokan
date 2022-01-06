<?php
/**
 * wp-graphql-dokan.
 * User: Duncan
 * Date: 28/12/2020
 * Time: 20:29
 */

namespace WPGraphQL\Dokan\Data\Loader;

use WPGraphQL\Data\Loader\AbstractDataLoader;
use WPGraphQL\Dokan\Model\Vendor;

class DokanVendorLoader extends AbstractDataLoader
{
    public function loadKeys(array $keys)
    {
        if ( empty($keys)) {
            return $keys;
        }

        $all_vendors = [];

        $args = [
            'include' => $keys,
            'number' => count($keys),
            'orderby' => 'include',
            'count_total' => false,
            'fields' => 'ids',
        ];

        $query = new \WP_User_Query( $args );
        $vendors = $query->get_results();

        if ( empty( $vendors ) || ! is_array( $vendors ) ) {
            return [];
        }

        foreach ($keys as $key) {
            $all_vendors[ $key ] = new Vendor( $key );
        }

        return $all_vendors;
    }
}