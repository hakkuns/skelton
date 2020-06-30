<?php

namespace App\Models;

use App\Events\OrderCreateEvent;
use App\Repositories\CartRepository;
use App\Models\ShoppingCart;
use App\Models\Order;
use App\Repositories\OrderRepository;

class CheckoutRepository
{
    /**
     * @param array $data
     *
     * @return Order
     */
    public function buildCheckoutItems(array $data) : Order
    {
        $orderRepo = new OrderRepository(new Order);

        $order = $orderRepo->createOrder([
            'reference' => $data['reference'],
            'customer_id' => $data['customer_id'],
            'address_id' => $data['address_id'],
            'order_status_id' => $data['order_status_id'],
            'payment' => $data['payment'],
            'discounts' => $data['discounts'],
            'total_products' => $data['total_products'],
            'total' => $data['total'],
            'total_paid' => $data['total_paid'],
            'tax' => $data['tax']
        ]);

        return $order;
    }
}
