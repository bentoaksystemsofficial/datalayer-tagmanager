<?php

add_action('woocommerce_checkout_order_processed', 'custom_push_checkout_data', 10, 2);

function custom_push_checkout_data($order_id, $posted_data) {
    // Get the current WooCommerce order
    $order = wc_get_order($order_id);

    // Check if the order exists
    if ($order) {
        // Get order data
        $currency = $order->get_currency();
        $total = $order->get_total();
        $coupon_code = $order->get_coupon_codes();

        // Get items from the order
        $items = array();
        foreach ($order->get_items() as $item_id => $item) {
            $product_id = $item->get_product_id();
            $product = $item->get_product();
            $product_name = $product->get_name();
            $affiliation = get_bloginfo('name');
            $coupon = implode(', ', $order->get_coupon_codes());
            $discount = $order->get_discount_total();
            $index = $item_id;
            // Get category IDs
            $category_ids = $product->get_category_ids();
            $category_names = array_unique(array_map(function ($category_id) {
                $category = get_term($category_id, 'product_cat');
                return ($category && !is_wp_error($category)) ? $category->name : '';
            }, $category_ids));
            $category = implode(', ', $category_names);
            $list_id = 'related_products';
            $list_name = 'Related Products';
            $variant = $product->get_attribute('color');
            $price = $product->get_price();
            $quantity = $item->get_quantity();

            // Build the array using the variables
            $items[] = array(
                'item_id' => $product_id,
                'item_name' => $product_name,
                'affiliation' => $affiliation,
                'coupon' => $coupon,
                'discount' => $discount,
                'index' => $index,
                'item_category' => $category,
                'item_list_id' => $list_id,
                'item_list_name' => $list_name,
                'item_variant' => $variant,
                'price' => $price,
                'quantity' => $quantity,
            );
        }

        // Push data to the data layer
        echo '<script>';
        echo 'window.dataLayer = window.dataLayer || [];';
        echo 'dataLayer.push({ ecommerce: null });';
        echo 'dataLayer.push({';
        echo '  event: "begin_checkout",';
        echo '  ecommerce: {';
        echo '    currency: "' . esc_js($currency) . '",';
        echo '    value: ' . esc_js($total) . ',';
        echo '    coupon: "' . esc_js(implode(', ', $coupon_code)) . '",';
        echo '    items: ' . json_encode($items);
        echo '  }';
        echo '});';
        echo '</script>';
    }
}
