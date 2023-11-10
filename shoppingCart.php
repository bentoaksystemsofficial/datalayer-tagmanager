<?php

function capture_cart_data_on_add_to_cart($cart_item_key, $product_id, $quantity, $variation_id, $variation, $cart_item_data) {
    // Access cart data.
    $cart = WC()->cart->get_cart();

    // Prepare an array to store cart item data
    $cart_items_data = array();

    // Process $cart as needed.
    foreach ($cart as $cart_item) {
        // Access individual cart item data.
        $product_name = $cart_item['data']->get_name();
        $item_id = $cart_item['product_id'];
        $item_quantity = $cart_item['quantity'];
        $item_price = $cart_item['data']->get_price();

        // Add individual cart item data to the array
        $cart_items_data[] = array(
            'item_id' => $item_id,
            'item_name' => $product_name,
            'quantity' => $item_quantity,
            'price' => $item_price,
        );
    }

    // Prepare data for Google Tag Manager
    $data = array(
        'event' => 'add_to_cart',
        'ecommerce' => array(
            'currency' => get_woocommerce_currency(),
            'value' => WC()->cart->get_cart_contents_total(),
            'items' => $cart_items_data,
        ),
    );

    // Convert data to JSON
    $data_json = json_encode($data);

    // Add the JavaScript code to the Data Layer
    echo '<script>';
    echo 'window.dataLayer = window.dataLayer || [];';
    echo 'dataLayer.push(' . $data_json . ');';
    echo '</script>';
}

add_action('woocommerce_add_to_cart', 'capture_cart_data_on_add_to_cart', 10, 6);

// Capture data when an item is removed from the cart
function capture_cart_data_on_remove_from_cart($cart_item_key, $cart) {
    // Access removed item data.
    // Access removed item data.
    $removed_product_id = $cart->removed_cart_contents[$cart_item_key]['product_id'];
    $removed_product = wc_get_product($removed_product_id);
    $removed_product_name = $removed_product->get_name();
    $removed_quantity = $cart->removed_cart_contents[$cart_item_key]['quantity'];
    $removed_product_price = $removed_product->get_price();

    // Prepare data for Google Tag Manager
    $data = array(
        'event' => 'remove_from_cart',
        'ecommerce' => array(
            'currency' => get_woocommerce_currency(),
            'value' => $removed_quantity * $removed_product_price,
            'items' => array(
                array(
                    'item_id' => $removed_product_id,
                    'item_name' => $removed_product_name,
                    'quantity' => $removed_quantity,
                    'price' => $removed_product_price,
                ),
            ),
        ),
    );

    // Convert data to JSON
    $data_json = json_encode($data);

    // Add the JavaScript code to the Data Layer
    echo '<script>';
    echo 'window.dataLayer = window.dataLayer || [];';
    echo 'dataLayer.push(' . $data_json . ');';
    echo '</script>';
}

add_action('woocommerce_remove_cart_item', 'capture_cart_data_on_remove_from_cart', 10, 2);
