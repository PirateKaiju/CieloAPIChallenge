<?php

namespace App;

use Cielo\API30\Ecommerce\CieloEcommerce;
use Cielo\API30\Ecommerce\CreditCard;
use Cielo\API30\Ecommerce\Environment;
use Cielo\API30\Ecommerce\Payment;
use Cielo\API30\Ecommerce\Request\CieloRequestException;
use Cielo\API30\Ecommerce\Sale;
use Cielo\API30\Merchant;


    //Doc here
    class HandlerCielo{

        public function __construct(){

            $this->environment = Environment::sandbox();
            $this->merch = new Merchant(MERCH_ID, MERCH_KEY);

        }


        public function fillSale($id, $customer_name, $payment_value){

            $sale = new Sale($id);

            $customer = $sale->customer($customer_name);

            $payment = $sale->payment($payment_value);

            
            //TODO: ENABLE CUSTOM
            $payment->setType(Payment::PAYMENTTYPE_CREDITCARD)
                    ->creditCard("123", CreditCard::VISA)
                    ->setExpirationDate("12/2020")
                    ->setCardNumber("0000000000000001")
                    ->setHolder("Irineu");

            return $sale;

        }

        public function storeSale($sale){

            try{

                $result_sale = (new CieloEcommerce($this->merch, $this->environment))->createSale($sale);
                return $result_sale;

            }catch(CieloRequestException $e){
                
                $error = $e->getCieloError();
                return $error;

            }
        }

        public function readSaleById($paymentId){

            $sale = (new CieloEcommerce($this->merch, $this->environment))->getSale($paymentId);
            return $sale;
        }


    }



?>