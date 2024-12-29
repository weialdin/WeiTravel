<?php

namespace App\Services;

use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Transaction;

class MidtransService
{
    public function __construct()
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');
    }

    public function createTransaction($booking)
    {
        $params = [
            'transaction_details' => [
                'order_id' => 'booking-' . $booking->id,
                'gross_amount' => $booking->total_amount,
            ],
            'customer_details' => [
                'first_name' => $booking->customer->name,
                'email' => $booking->customer->email,
            ],
            'item_details' => [
                [
                    'id' => $booking->id,
                    'price' => $booking->sub_total,
                    'quantity' => $booking->quantity,
                    'name' => $booking->tour->title,
                ],
            ],
        ];

        return Snap::createTransaction($params);
    }

    public function getTransactionStatus($orderId)
    {
        return Transaction::status($orderId);
    }
}
