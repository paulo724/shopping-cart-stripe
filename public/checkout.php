<?php

require '../vendor/autoload.php';

use app\library\Cart;
use Stripe\StripeClient;

session_start();
header('Content-Type: application/json');

/* Variaveis com dados do stripe */
$stripeSecretKey = 'sk_test_51N3UsIGZ2CkNUhfuK1aD9b9mPUHaTE8EiZNw8SBcwpL2jVO3xlWHMdsq05kF4IlPGh1cHLP4EHS262R3dqss6VSt00qzUXQwC0';

// Dominio de redirecionamento 
$domain = 'http://localhost:8000';

$stripe = new StripeClient($stripeSecretKey);

$cart = new Cart;
$productsInCart = $cart->getCart();

$items = [
    'mode' => 'payment',
    'success_url' => $domain . '/success.php',
    'cancel_url' => $domain . '/cancel.php',
];

foreach ($productsInCart as $product) {
    $items['line_items'][] = [
        'price_data' => [
            'currency' => 'brl',
            'product_data' => [
                'name' => $product->getName()
            ],
            'unit_amount' => $product->getPrice() * 100
        ],
        'quantity' => $product->getQuantity()
    ];
}

$checkout_session = $stripe->checkout->sessions->create($items);

header("HTTP/1.1 303 See Other");
header("Location: " . $checkout_session->url);
