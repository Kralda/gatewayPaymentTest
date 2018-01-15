<?php
require("test.neon");
require("../vendor/autoload.php");

use Nette\Neon\Neon;
use OndraKoupil\Csob\Config;
use OndraKoupil\Csob\GatewayUrl;
use OndraKoupil\Csob\Payment;

/**
 * Created by PhpStorm.
 * User: Daniel Král
 * Date: 15.01.2018
 * Time: 17:39
 */
//Načtení neon souboru
$config = Neon::decode(file_get_contents('config/test.neon'));
function gatewayConfig(){
    $gatewayConfig = new Config(
        $config['gateway']['merchant_id'],
        $config['gateway']['private_public_key_path'],
        $config['gateway']['public_bank_key_path'],
        $config['gateway']['shop_title'],
        $config['gateway']['return_path'],
        // URL adresa API - výchozí je adresa testovacího (integračního) prostředí,
        // až budete připraveni přepnout se na ostré rozhraní, sem zadáte
        // adresu ostrého API. Nezapomeňte také na ostrý veřejný klíč banky.
        GatewayUrl::TEST_LATEST
    );
    return $gatewayConfig;
}
function paymentConf($item, $price){
    $payment = new Payment(mktime());
    $payment->addCartItem($item, 1, $price * 100);
    return $payment;
}