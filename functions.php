<?php 


// add delivery date column
function order_delivery_date( $columns ) {

    $new_columns = array();

    foreach ( $columns as $column_name => $column_info ) {

        $new_columns[$column_name] = $column_info;

        if ( 'order_date' === $column_name ) {
            $new_columns['order_delivery_date'] = __( 'Delivery Date', 'ptlido' );
        }

    }

    return $new_columns;
}

add_filter( 'manage_edit-shop_order_columns', 'order_delivery_date', 10 );

// Sortable delivery date column
function order_delivery_sortable( $columns ) {
    $custom = array(

        'order_delivery_date' => 'order_details_meta',

    );

    return wp_parse_args( $custom, $columns );
}

add_filter( "manage_edit-shop_order_sortable_columns", 'order_delivery_sortable' );

//Show delivery date in order list
function order_delivery_date_meta( $column ) {

    global $post;

    if ( 'order_delivery_date' === $column ) {

        $delivery_date = get_post_meta( $post->ID, 'delivery_date', true );
        echo '<p>' . $delivery_date . '</p>';

    }

}

add_action( 'manage_shop_order_posts_custom_column', 'order_delivery_date_meta' );
