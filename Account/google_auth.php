<?php
session_start();
require_once 'config.php';
require_once 'vendor/autoload.php';

$client_id = '601596676323-oc7v689e4ht9ncstqctb44nf7508blqq.apps.googleusercontent.com';
$client_secret = 'T9K860mYA_bsj2jVcTEJpVuv';
$redirect_uri = 'http://localhost/login.php';

$client = new Google_Client();
$client->setApplicationName("PHP Google OAuth Login Example");
$client->setClientId($client_id);
$client->setClientSecret($client_secret);
$client->setRedirectUri($redirect_uri);
$client->addScope("https://www.googleapis.com/auth/userinfo.email");
$client->addScope("https://www.googleapis.com/auth/userinfo.profile");

$objOAuthService = new Google_Service_Oauth2($client);

if (isset($_GET['code'])) {
  $client->authenticate($_GET['code']);
  $_SESSION['access_token'] = $client->getAccessToken();
  header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
}

if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
  $client->setAccessToken($_SESSION['access_token']);
}


if ($client->getAccessToken()) {
  $userData = $objOAuthService->userinfo->get();
  if (!empty($userData)) {
    $objDBController = new DBController();
    $existing_member = $objDBController->getUserByOAuthId($userData->id);
    if (empty($existing_member)) {
      $objDBController->insertOAuthUser($userData);
    }
  }
  $_SESSION['access_token'] = $client->getAccessToken();
} else {
  $authUrl = $client->createAuthUrl();
}
