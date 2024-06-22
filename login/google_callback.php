<?php

session_start();
require_once '../vendor/autoload.php';
require_once '../src/DB.php';
require_once '../src/User.php';

use vipBerber\User;
use vipBerber\DB;

DB::connect();

$google_client = new Google_Client();
$google_client->setClientId("515407427816-cqsh228eii9tc1gaut050effi45u7flu.apps.googleusercontent.com");
$google_client->setClientSecret("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");
$google_client->setRedirectUri("http://localhost/vipberber/login/google_callback.php");
$google_client->addScope("email");
$google_client->addScope("profile");

if (isset($_GET['code'])) {
    $token = $google_client->fetchAccessTokenWithAuthCode($_GET['code']);
    if (!isset($token['error'])) {
        $google_client->setAccessToken($token['access_token']);
        $google_service = new Google_Service_Oauth2($google_client);
        $google_account_info = $google_service->userinfo->get();

        $google_id = $google_account_info->id;
        $user_email = $google_account_info->email;
        $user_name = $google_account_info->name;

        // Kullanıcıyı veritabanında kontrol edin
        $user = User::where('user_mail', $user_email)->first();

        if (!$user) {
            // Kullanıcı veritabanında yoksa yeni kullanıcı oluştur
            $user = User::create([
                'user_full_name' => $user_name,
                'user_mail' => $user_email,
                'user_name' => $user_email,
                'user_password' => '', // Şifre gerekli değil
            ]);
        }

        // Kullanıcı oturumunu başlat
        $_SESSION['user_id'] = $user->user_id;
        $_SESSION['perm'] = "u";
        header('Location: ../Pages/default.php');
        exit();
    } else {
        die('Token hatası: ' . $token['error']);
    }
} else {
    die('Kod bulunamadı.');
}

