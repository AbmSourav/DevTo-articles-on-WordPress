<?php
namespace DevToWP;

defined( 'ABSPATH' ) || die();
/**
 * @package DevToWP
 */

class Engine {

    public static $data;

    public static function dev_to_get_posts($user_name) {
        $request = wp_remote_get( 'https://dev.to/api/articles?username='.trim($user_name) );

        if( is_wp_error( $request ) ) {
            return false;
        }

        $body = wp_remote_retrieve_body( $request );
        $data = json_decode( $body, true );

        if ( !empty( $data ) ) {
            self::$data = $data;
        }
        return $data;
    }

}
