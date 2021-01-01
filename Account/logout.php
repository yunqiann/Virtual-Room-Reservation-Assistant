<?php
require_once "google_auth.php";

//Logout
unset($_SESSION['access_token']);
$client->revokeToken();
unset($client);
// header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL)); //redirect user back to page
header("Location: ../login.php");
?>
