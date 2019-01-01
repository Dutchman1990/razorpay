<?php 
$payment_id=$_GET['id'];             //payment id from call back function
$url = "https://YOUR_API_KEY:YOUR_API_SECRET_KEY@api.razorpay.com/v1/payments/$payment_id";
$exchange = json_decode(file_get_contents($url), true);
echo '<pre>';
print_r($exchange);          //DATA
echo '</pre>';


EXAMPLE DATA
Array
(
    [id] => pay_BemyzVgaPrZZsN              //PAYMENT ID 
    [entity] => payment
    [amount] => 1544290
    [currency] => INR
    [status] => captured
    [order_id] => order_BemyjkVGwpui0B
    [invoice_id] => inv_BemyjeCmrQxF70
    [international] => 
    [method] => card
    [amount_refunded] => 0
    [refund_status] => 
    [captured] => 1
    [description] => Silver  PLAN PAYMENT
    [card_id] => card_Bemz0gz9hCQvMA
    [bank] => 
    [wallet] => 
    [vpa] => 
    [email] => nirjhar.mistry@maxmobility.biz
    [contact] => +919836333484
    [customer_id] => cust_BeTCiZYWWxd5HV
    [notes] => Array
        (
        )

    [fee] => 52847
    [tax] => 8062
    [error_code] => 
    [error_description] => 
    [created_at] => 1546348459
)
