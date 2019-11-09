<?php

use App\HandlerCielo;

require 'vendor/autoload.php';

require_once "config.php";

$handler = new HandlerCielo();


/*
//EXAMPLE
$actual_sale = $handler->fillSale("123", "Irineu", 10);

$result = $handler->storeSale($actual_sale);

var_dump($result);

$paymentId = $result->getPayment()->getPaymentId();

$query_res = $handler->readSaleById($paymentId);

var_dump($query_res);*/


$result = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

    //TODO: INPUT VALIDATION

    $result = $handler->readSaleById($_POST["sale_payment_id"]);

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Luiz's Cielo Test Sample</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.0/css/bulma.min.css">
</head>
<body>

    <section class="section">
        <div class="tabs has-text-black is-centered">
            <ul>
                <li><a href="/index.php">Envio de Venda</a></li>
                <li><a href="/consulta.php">Consulta</a></li>
            </ul>
        </div>
        <div class="container is-fluid">
            <div class="hero is-light">
                <div class="hero-body">

                    
                    
                    <h1 class="title has-text-black">Consulta</h1>

                    <form id="formConsulta" class="box" action="" method="POST">

                    <div class="field">
                        
                        <label class="label">Identificador de pagamento da venda (Numérico)</label>
                        <div class="control">
                            <input name="sale_payment_id" class="input" type="text" value="">
                        </div>

                        <br>
                        <br>

                        <div class="field">
                            <div class="control is-centered has-text-centered">
                                <input class="button is-primary" type="submit" value="Consultar">
                            </div>
                        </div>

                    </div>

                    </form>

                    <br>

                    <h1 class="title has-text-black">Resultado: </h1>

                    <div class="box">

                        <?php if($result): ?>
                        
                            <p>
                            
                            Identificador do Pagamento: <?php echo $result->getPayment()->getPaymentId(); ?>

                            </p>

                            <p>
                            
                            Nome do cliente: <?php echo $result->getCustomer()->getName(); ?>

                            </p>

                            <p>
                            
                            Tipo: <?php echo $result->getPayment()->getType(); ?>

                            </p>

                            <p>
                            
                            Valor do Pagamento: <?php echo $result->getPayment()->getAmount(); ?>

                            </p>

                            <p>
                            
                            País: <?php echo $result->getPayment()->getCountry(); ?>

                            </p>

                            <p>
                            
                            Data de processamento: <?php echo $result->getPayment()->getReceivedDate(); ?>

                            </p>

                            <p>
                            
                            Cartão: <?php echo $result->getPayment()->getCreditCard()->getCardNumber(); ?>

                            </p>
                        
                        <p>
                            <?php 
                            

                                var_dump($result);


                            ?>
                        </p>

                        <?php endif;?>
                    </div>

                </div>
            </div>
        </div>
    </section>
    
</body>
</html>
