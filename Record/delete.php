<?php
require_once "../Account/config.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './vendor/phpmailer/phpmailer/src/Exception.php';
require './vendor/phpmailer/phpmailer/src/PHPMailer.php';
require './vendor/phpmailer/phpmailer/src/SMTP.php';

$data = new stdClass();
// $data->date = isset($_GET['date']) ? $_GET['date'] : '';
// $data->time = isset($_GET['time']) ? $_GET['time'] : '';
// $data->room = isset($_GET['room']) ? $_GET['room'] : '';
$data->date = isset($_POST['date']) ? $_POST['date'] : '';
$data->time = isset($_POST['time']) ? $_POST['time'] : '';
$data->room = isset($_POST['room']) ? $_POST['room'] : '';
$room = $data->room;
$member1 = isset($_POST['member1']) ? $_POST['member1'] : '';
$member2 = isset($_POST['member2']) ? $_POST['member2'] : '';
$member3 = isset($_POST['member3']) ? $_POST['member3'] : '';
$member4 = isset($_POST['member4']) ? $_POST['member4'] : '';

function timeToStr($time)
{
    $timeStr = "";
    foreach ($time as $t) {
        if ($t == 0) {
            $timeStr .= "08:00-09:00\n";
        } else if ($t == 1) {
            $timeStr .= "09:00-10:00\n";
        } else if ($t == 2) {
            $timeStr .= "10:00-11:00\n";
        } else if ($t == 3) {
            $timeStr .= "11:00-12:00\n";
        } else if ($t == 4) {
            $timeStr .= "12:00-13:00\n";
        } else if ($t == 5) {
            $timeStr .= "13:00-14:00\n";
        } else if ($t == 6) {
            $timeStr .= "14:00-15:00\n";
        } else if ($t == 7) {
            $timeStr .= "15:00-16:00\n";
        } else if ($t == 8) {
            $timeStr .= "16:00-17:00\n";
        }
    }
    return $timeStr;
}

function cancelEmailBody($date, $time, $room)
{
    $m_time=timeToStr($data->time);
    $m_body="<html><span>Your meeting has been cancelled.</span><br><span>Date: $date</span><br><span>Time: $time</span><br><span>Room: $room</span><br><span>Host:host</span><br><span>Member(s): <br>$member1<br>$member2<br>$member3<br>$member4<br></span><br></html>";
    return $m_body;
}

$mail = new PHPMailer();
$mail->SMTPSecure = "ssl";
$mail->Host = "smtp.gmail.com";
$mail->Port = 465;
$mail->CharSet = "utf-8";    //信件編碼
$mail->Username = "seproject1804@gmail.com";        //帳號，例:example@gmail.com
$mail->Password = "kthjigwbhjcnefps";        //密碼
$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->SMTPDebug  = 1;
$mail->Encoding = "base64";
$mail->IsHTML(true);     //內容HTML格式
$mail->From = "seproject1804@gmail.com";        //寄件者信箱
$mail->FromName = "Virtual Room Reservation System";    //寄信者姓名
$mail->Subject = "Virtual Room Reservation System Notification";     //信件主旨
$mail->WordWrap = 70;
//$time_mailbody = timeToStr($time);
//$tmp_url = googleCalendarURL($date, $time, $room);
//$mail->Body = "<html><span>This is a meeting Reminder.</span><br><span>Date: $date</span><br><span>Time: $time_mailbody</span><br><span>Room: $room</span><br><span>Member(s): <br>$member1<br>$member2<br>$member3<br>$member4<br></span><span>$tmp_url</span><br></html>";
$mail->Body=cancelEmailBody($data->date,$data->time,$data->room);
//$mail->AddAddress($data->email);   //host信箱
$mail->AddAddress($member1);
$mail->AddAddress($member2);
$mail->AddAddress($member3);
$mail->AddAddress($member4);
if (!$mail->Send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
}



$objDBController = new DBController();
$objDBController->deleteReocrd($data);

unset($objDBController);
unset($data);
Header("Location: http://localhost/reservation_record.php");
