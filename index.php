<?php

require 'vendor/autoload.php';

use Cielo\API30\Merchant;

use Cielo\API30\Ecommerce\Environment;
use Cielo\API30\Ecommerce\Sale;
use Cielo\API30\Ecommerce\CieloEcommerce;
use Cielo\API30\Ecommerce\Payment;
use Cielo\API30\Ecommerce\CreditCard;

use Cielo\API30\Ecommerce\Request\CieloRequestException;

define("MERCH_ID", "ba61abe4-33ad-4933-856b-87f33acd4876");
define("MERCH_KEY", "GRWRNLOVGGRNCFYSMSTMMUXPSKOKPGCTQPDCTHMV");

// ...
// Configure o ambiente
$environment = $environment = Environment::sandbox();

// Configure seu merchant
$merchant = new Merchant(MERCH_ID, MERCH_KEY);

// Crie uma instância de Sale informando o ID do pedido na loja
$sale = new Sale('123');

// Crie uma instância de Customer informando o nome do cliente
$customer = $sale->customer('Fulano de Tal');

// Crie uma instância de Payment informando o valor do pagamento
$payment = $sale->payment(15700);

// Crie uma instância de Credit Card utilizando os dados de teste
// esses dados estão disponíveis no manual de integração
$payment->setType(Payment::PAYMENTTYPE_CREDITCARD)
        ->creditCard("123", CreditCard::VISA)
        ->setExpirationDate("12/2020")
        ->setCardNumber("0000000000000001")
        ->setHolder("Fulano de Tal");


//echo "Success";

// Crie o pagamento na Cielo
try {
    // Configure o SDK com seu merchant e o ambiente apropriado para criar a venda
    $sale = (new CieloEcommerce($merchant, $environment))->createSale($sale);

    //var_dump($sale);

    // Com a venda criada na Cielo, já temos o ID do pagamento, TID e demais
    // dados retornados pela Cielo
    $paymentId = $sale->getPayment()->getPaymentId();
    //$paymentId = "b932a2a6-95b8-469b-b647-7a93bef587be";

    // Com o ID do pagamento, podemos fazer sua captura, se ela não tiver sido capturada ainda
    //$sale = (new CieloEcommerce($merchant, $environment))->captureSale($paymentId, 15700, 0);

    $sale = (new CieloEcommerce($merchant, $environment))->getSale($paymentId);

    var_dump($sale);



    // E também podemos fazer seu cancelamento, se for o caso
    $sale = (new CieloEcommerce($merchant, $environment))->cancelSale($paymentId, 15700);
    //var_dump($sale);
} catch (CieloRequestException $e) {
    // Em caso de erros de integração, podemos tratar o erro aqui.
    // os códigos de erro estão todos disponíveis no manual de integração.
    $error = $e->getCieloError();

    var_dump($error);
}





/*require "vendor/autoload.php";

use Cielo\API30\Ecommerce\CieloEcommerce;
use Cielo\API30\Ecommerce\CreditCard;
use Cielo\API30\Ecommerce\Environment;
use Cielo\API30\Ecommerce\Payment;
use Cielo\API30\Ecommerce\Request\CieloRequestException;
use Cielo\API30\Ecommerce\Sale;
use Cielo\API30\Merchant;

define("MERCH_ID", "ba61abe4-33ad-4933-856b-87f33acd4876");
define("MERCH_KEY", "GRWRNLOVGGRNCFYSMSTMMUXPSKOKPGCTQPDCTHMV");




$environment = Environment::sandbox();

$merchant = new Merchant(MERCH_ID, MERCH_KEY);

$sale = new Sale("123");

$customer = $sale->customer("Irineu");

$payment = $sale->payment(9999);

$payment->setType(Payment::PAYMENTTYPE_CREDITCARD)
        ->creditCard("123", CreditCard::MASTERCARD)
        ->setExpirationDate("12/2020")
        ->setCardNumber("0000000000000001")
        ->setCustomerName("Irineu");

try{

    $sale = (new CieloEcommerce($merchant, $environment))->createSale($sale);

    $paymentId = $sale->getPayment()->getPaymentId();

    $sale = (new CieloEcommerce($merchant, $environment))->captureSale($paymentId, 9999, 0);

    echo $sale->getAmount();

    $sale = (new CieloEcommerce($merchant, $$environment))->cancelSale($paymentId, 9999);

} catch(CieloRequestException $e){

    echo $e->getCieloError();

}*/




?>