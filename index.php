<?php
require("config/payment.php");
use OndraKoupil\Csob\Client;

if (isset($_POST['submit'])) {
    if ($_POST['text'] != "" && $_POST['cena'] != "") {
        $gatewayConfig = gatewayConfig();
        $client = new Client($gatewayConfig);
        $payment = paymentConf(htmlspecialchars($_POST['text']),$_POST['cena']);
        $response = $client->paymentInit($payment);
        $payId = $payment->getPayId();
        $payId = $response["payId"];
        $url = $client->getPaymentProcessUrl($payment);
        header("Location:" . $url);
    } else {
        echo "Prosím vyplňte název i cenu položky.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ČSOB platba</title>
</head>
<body>
<form method="post">
    Název položky: <input type="text" name="text" placeholder="Běžný text"> <br>
    Cena položky: <input type="number" name="cena" placeholder="">  <br>
    <button type="submit" name="submit">Zaplatit</button>
</form>
</body>
</html>
