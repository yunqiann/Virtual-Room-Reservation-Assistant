<?
require_once "availability.php";
require_once "Account/config.php";

// $record = array($date, $time, $rome, $email, $member1, $member2, $member3, $member4);
// die($record->email);
die($email);
$objDBController = new DBController();
$records = $objDBController->insertReocrd($record);


