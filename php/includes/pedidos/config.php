<?php

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;

require __ROOT."autoload.php";

// For test payments we want to enable the sandbox mode. If you want to put live
// payments through then this setting needs changing to `false`.
$enableSandbox = true;

// PayPal settings. Change these to your account details and the relevant URLs
// for your site.
$paypalConfig = [
    'client_id' => 'AcTlpUzbsIKOrXjzISjnqqdpi7g97hJj1Dlw0pwWnDhBZTRyDKmz337aYh8IMghoIspj8c0yCukSmnQ8',
    'client_secret' => 'EJgpZurwOIdP8EATxtm4pB9JffxEEZ7Axe9wgTrou5JhOq7R2zlewFQfCKowoOSNixD-GVTW4ahT4ayI',
    'return_url' => __HS_ROOT."php/includes/pedidos/payResponse.php",
    'cancel_url' => __HS_ROOT."html/comprador/c-compraExitosa.php"
];

$apiContext = getApiContext($paypalConfig['client_id'], $paypalConfig['client_secret'], $enableSandbox);

/**
 * Set up a connection to the API
 *
 * @param string $clientId
 * @param string $clientSecret
 * @param bool   $enableSandbox Sandbox mode toggle, true for test payments
 * @return \PayPal\Rest\ApiContext
 */
function getApiContext($clientId, $clientSecret, $enableSandbox)
{
    $apiContext = new ApiContext(
        new OAuthTokenCredential($clientId, $clientSecret)
    );

    $apiContext->setConfig([
        'mode' => $enableSandbox ? 'sandbox' : 'live'
    ]);

    return $apiContext;
}