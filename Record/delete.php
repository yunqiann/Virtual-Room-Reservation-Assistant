<?php
require_once "../Account/config.php";


$data = new stdClass();
// $data->date = isset($_GET['date']) ? $_GET['date'] : '';
// $data->time = isset($_GET['time']) ? $_GET['time'] : '';
// $data->room = isset($_GET['room']) ? $_GET['room'] : '';
$data->date = isset($_POST['date']) ? $_POST['date'] : '';
$data->time = isset($_POST['time']) ? $_POST['time'] : '';
$data->room = isset($_POST['room']) ? $_POST['room'] : '';
$member1 = isset($_POST['member1']) ? $_POST['member1'] : '';
$member2 = isset($_POST['member2']) ? $_POST['member2'] : '';
$member3 = isset($_POST['member3']) ? $_POST['member3'] : '';
$member4 = isset($_POST['member4']) ? $_POST['member4'] : '';

$objDBController = new DBController();
$objDBController->deleteReocrd($data);
$email = $objDBController->SearchuserEmail($data);

// Add Email Function


//


unset($objDBController);
unset($data);
Header("Location: http://localhost/reservation_record.php");
