<?php
require_once "../Account/config.php";


$data = new stdClass();
// $data->date = isset($_GET['date']) ? $_GET['date'] : '';
// $data->time = isset($_GET['time']) ? $_GET['time'] : '';
// $data->room = isset($_GET['room']) ? $_GET['room'] : '';
$data->date = isset($_POST['date']) ? $_POST['date'] : '';
$data->time = isset($_POST['time']) ? $_POST['time'] : '';
$data->room = isset($_POST['room']) ? $_POST['room'] : '';

$objDBController = new DBController();
$objDBController->deleteReocrd($data);

unset($objDBController);
unset($data);
Header("Location: http://localhost/reservation_record.php");
