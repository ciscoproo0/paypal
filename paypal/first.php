<?php

require __DIR__ . '/vendor/autoload.php';

$apiContext = new \PayPal\Rest\ApiContext(new \PayPal\Auth\OAuthTokenCredential('AQMvz-l3XHRLi2aHA0oSANfks5l-VwwS40Los6JPnGCLFceyXAN1LTnharyA0s5GrsFjYhh2iNxpeNrj', 'EDjYV3HndXdvNAbTYRcmSX9oZBHYFzqciEaasVUJd4Huez84IJCmtKZ1N_IM4Vs6Gh3BE_CX0NYxf4eD'));

$payer = new \PayPal\Api\Payer();
$payer->setPaymentMethod('paypal');

$amount = new \PayPal\Api\Amount();
$amount->setTotal('10.00');
$amount->setCurrency('BRL');

$transaction = new \PayPal\Api\Transaction();
$transaction->setAmount($amount);

$redirectUrls = new \PayPal\Api\RedirectUrls();
$redirectUrls->setReturnUrl("https://example.com/your_redirect_url.html")
            ->setCancelUrl("https://example.com/your_cancel_url.html");

$payment = new \PayPal\Api\Payment();
$payment->setIntent('sale')
    ->setPayer($payer)
    ->setTransactions(array($transaction))
    ->setRedirectUrls($redirectUrls);

    try {
        $payment->create($apiContext);
        echo "<pre>" .$payment. "</pre>";

        $_SESSION['approval2'] = $payment->getApprovalLink();

        RandomID(16);
    
        echo "\n\nRedirect user to approval_url:  <pre>" . $payment->getApprovalLink() . "\n</pre>";
    }
    catch (\PayPal\Exception\PayPalConnectionException $ex) {
        echo $ex->getData();
    }

?>