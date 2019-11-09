
<?php
    use App\HandlerCielo;

    require 'vendor/autoload.php';

    require_once "config.php";

    $handler = new HandlerCielo();

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
                <li><a href="/exemplo.php">Exemplo Simplificado</a></li>
            </ul>
        </div>
        <div class="container is-fluid">
            <div class="hero is-light">
                <div class="hero-body">

                <h1 class="title has-text-black">Exemplo</h1>

                <?php 
                
                    $id = "001";
                    $nome = "ClienteTeste 1";
                    $valor = 10;
                    $exp_date = "12/2020";
                    $card_number = "0000000000000001"


                ?>

                <h3 class="subtitle has-text-black">Registro</h3>

                <p>O exemplo a seguir será enviado como uma venda e consultado logo em seguida: </p>

                <p><?php echo "Identificador: ". $id . " Nome do cliente: ". $nome. " Valor: ".$valor . " Num. do cartão: " . $card_number . " Expiração do cartão: " .$exp_date; ?></p>

                <?php
                
                    $actual_sale = $handler->fillSale($id, $nome, $valor, $card_number, $exp_date);

                    $result = $handler->storeSale($actual_sale);
                    
                    //var_dump($result);
                    
                    if($result){
                        echo "<br>Venda enviada<br>";
                    }

                ?>

                <h3 class="subtitle has-text-black">Consulta</h3>

                <?php
                    $paymentId = $result->getPayment()->getPaymentId();
                        
                    $query_res = $handler->readSaleById($paymentId);

                ?>

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

                <p>Objeto retornado da consulta: </p>

                <?php
                    var_dump($query_res);
                ?>
                
                </div>
            </div>
        </div>
    </section>
    
</body>
</html>