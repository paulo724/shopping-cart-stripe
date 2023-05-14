<?php

require '../vendor/autoload.php';

use app\library\Cart;
use Stripe\StripeClient;

session_start();

$stripeSecretKey = 'sk_test_51N3UsIGZ2CkNUhfuK1aD9b9mPUHaTE8EiZNw8SBcwpL2jVO3xlWHMdsq05kF4IlPGh1cHLP4EHS262R3dqss6VSt00qzUXQwC0';

$stripe = new StripeClient($stripeSecretKey);

$cart = new Cart;

header('Content-Type: application/json');

$YOUR_DOMAIN = 'http://localhost:8000';

$checkout_session = $stripe->checkout->sessions->create([
    'line_items' => [[
        'price_data' => [
            'currency' => 'brl',
            'product_data' => [
                'name' => 'Geladeira',
            ],
            'unit_amount' => '20000',
        ],
        'quantity' => 4,
    ]],
    'mode' => 'payment',
    'success_url' => $YOUR_DOMAIN . '/success.html',
    'cancel_url' => $YOUR_DOMAIN . '/cancel.html',
]);

header("HTTP/1.1 303 See Other");
header("Location: " . $checkout_session->url);
