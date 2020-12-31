<?php
// require_once "availability.php";
require_once "../Account/config.php";

header("Content-Type: application/json");

$date = isset($_POST['date']) ? $_POST['date'] : '';
$time = isset($_POST['time']) ? $_POST['time'] : [];
$room = isset($_POST['room']) ? $_POST['room'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$member1 = isset($_POST['member1']) ? $_POST['member1'] : '';
$member2 = isset($_POST['member2']) ? $_POST['member2'] : '';
$member3 = isset($_POST['member3']) ? $_POST['member3'] : '';
$member4 = isset($_POST['member4']) ? $_POST['member4'] : '';

$objDBController = new DBController();
$record = new stdClass();
$record->date = $date;
$record->room = $room;
$record->email = $email;
$record->member1 = $member1;
$record->member2 = $member2;
$record->member3 = $member3;
$record->member4 = $member4;
for ($i = 0; $i < count($time); $i++) {
    $record->time = $time[$i];
    $objDBController->insertReocrd($record);
}

unset($objDBController);

echo json_encode($record);