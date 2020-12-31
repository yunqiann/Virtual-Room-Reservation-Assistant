<?php
// require_once "availability.php";
require_once "Account/config.php";

header("Content-Type: application/json");

$date = isset($_POST['date']) ? $_POST['date'] : '';
$time = isset($_POST['time']) ? $_POST['time'] : [];
$room = isset($_POST['room']) ? $_POST['room'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$member1 = isset($_POST['member1']) ? $_POST['member1'] : '';
$member2 = isset($_POST['member2']) ? $_POST['member2'] : '';
$member3 = isset($_POST['member3']) ? $_POST['member3'] : '';
$member4 = isset($_POST['member4']) ? $_POST['member4'] : '';

// $objDBController = new DBController();
// for ($i = 0; $i < count($time); $i++) {
//     $record = [
//         'date' => $date,
//         'time' => $time[$i],
//         'email' => $email,
//         'room' => $room,
//         'member1' => $member1,
//         'member2' => $member2,
//         'member3' => $member3,
//         'member4' => $member4
//     ];
//     $objDBController->insertReocrd($record);
// }

// unset($objDBController);

$record = array(
    'date' => $date,
    'time' => $time,
    'room' => $room,
    'email' => $email,
    'member1' => $member1,
    'member2' => $member2,
    'member3' => $member3,
    'member4' => $member4
);
$date = "INSERT INTO Record VALUES '$record[0]', '$record[1]', '$record[2]', '$record[3]', '$record[4]', '$record[5]', '$record[6]', '$record[7]')";
// $date = "INSERT INTO Record VALUES '$date', '$time', '$email', '$room', '$member1', '$member2', '$member3', '$member4')";
// $record = [
//     'date' => $date,
//     'time' => $time[$i],
//     'email' => $email,
//     'room' => $room,
//     'member1' => $member1,
//     'member2' => $member2,
//     'member3' => $member3,
//     'member4' => $member4
// ];



echo json_encode($record);
// header("Location: http://localhost");