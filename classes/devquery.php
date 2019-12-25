<?php
namespace DevToWP;

defined( 'ABSPATH' ) || die();
/**
 * @package DevToWP
 */

class DevQuery extends Engine {

    public static function dev_query($atts) {
        $atts = shortcode_atts(
            array(
                'user_name' => '',
                'post' => '-1',
                'layout' => 'single'
            ),
            $atts
        );

        if ( empty( $atts['user_name'] ) ) {
            return sprintf( "<p>%s</p>", esc_html__( 'User Name is not set in the shortcode.', 'devtowp' ) );
        }
        self::dev_to_get_posts($atts['user_name']);

        $data = self::$data;
        if ( !empty( $data ) && count($data) > $atts['post'] && $atts['post'] != -1 ) {
             $data = array_splice($data, 0, $atts['post'] );
        }

        ob_start();
            if ( !empty( $data ) ) {
                View::markup($data, $atts);
//                Markup::view();
            } else {
             return sprintf( "<p>%s</p>", esc_html__( 'Nothing Found.', 'devtowp' ) );
            }
        return ob_get_clean();

    }

}
