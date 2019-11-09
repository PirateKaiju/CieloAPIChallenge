<?php

    namespace App;

    use Cielo\API30\Ecommerce\CieloEcommerce;
    use Cielo\API30\Ecommerce\CreditCard;
    use Cielo\API30\Ecommerce\Environment;
    use Cielo\API30\Ecommerce\Payment;
    use Cielo\API30\Ecommerce\Request\CieloRequestException;
    use Cielo\API30\Ecommerce\Sale;
    use Cielo\API30\Merchant;

    /**
    *    HandlerCielo is an API handling class for demonstration purposes, intended to provide
    * access to Cielo API. This class requires the use of Cielo API Version 3.0 for PHP
    *    @package app
    *    @author Luiz Antonio
    *
    */

    class HandlerCielo{

        public function __construct(){
            //TODO: PASS VALUES BY PARAMETER INSTEAD

            $this->environment = Environment::sandbox();
            //The sandbox environment allow for a more "test-based" API usage 
            $this->merch = new Merchant(MERCH_ID, MERCH_KEY);
            //The constants are needed for using the API

        }


        public function fillSale($id, $customer_name, $payment_value, $card_number, $card_exp_date){

            $sale = new Sale($id);

            //It is necessary to set the sale parameters with the proper methods
            $customer = $sale->customer($customer_name);

            $payment = $sale->payment($payment_value);

            //TODO: ENABLE CUSTOM CARD/PAYMENT OPTIONS
            $payment->setType(Payment::PAYMENTTYPE_CREDITCARD)
                    ->creditCard($id, CreditCard::VISA)
                    ->setExpirationDate($card_exp_date)
                    ->setCardNumber($card_number)
                    ->setHolder($customer_name);

            return $sale;

        }

        public function storeSale($sale){
            //The sale object should come from "fillSale"
            try{

                $result_sale = (new CieloEcommerce($this->merch, $this->environment))->createSale($sale);
                return $result_sale;

            }catch(CieloRequestException $e){
                
                $error = $e->getCieloError();
                return $error;

            }
        }

        public function readSaleById($paymentId){
            //The payment id can be obtained using the methods on the sale object
            try{

                $sale = (new CieloEcommerce($this->merch, $this->environment))->getSale($paymentId);
                return $sale;

            }catch(CieloRequestException $e){
                    
                $error = $e->getCieloError();
                //TODO: OTHER TYPES OF ERROR HANDLING

                //var_dump($error);

                return $error;

            }

        }


    }



?>