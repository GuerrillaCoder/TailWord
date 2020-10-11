<?php
class Tailwindcss_ThemeFunctions{
    public function __construct()
    {

    }

    public function addView($post_id) {

        $key = 'post_views_count';
        $count = (int) get_post_meta( $post_id, $key, true );
        $count++;
        update_post_meta( $post_id, $key, $count );
    }

    public function getViewCount($post_id){
        $key = 'post_views_count';
        return (int) get_post_meta( $post_id, $key, true );
    }

}