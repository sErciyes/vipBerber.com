<?php
require_once '../vendor/autoload.php';

$google_client = new Google_Client();
$google_client->setClientId("515407427816-cqsh228eii9tc1gaut050effi45u7flu.apps.googleusercontent.com");
$google_client->setClientSecret("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");
$google_client->setRedirectUri("http://localhost/vipberber/login/login.php");
$google_client->addScope("profile");
