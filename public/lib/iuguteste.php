<?php

require_once("iugu-php/lib/Iugu.php");

Iugu::setApiKey("96A74E16925F4177908328252DE0187A"); // Ache sua chave API no Painel

Iugu_Charge::create(
    Array(
      "token"=> "15653a119791039173c8d28f6628b790",
      "email"=>"fernando.mendes@webca.com.br",
      "items" => 
      Array(
        Array(
          "description"=>"Item Teste",
          "quantity"=>"1",
          "price_cents"=>"1000"
          )
        )
      )
    );

?>