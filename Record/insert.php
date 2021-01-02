<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './vendor/phpmailer/phpmailer/src/Exception.php';
require './vendor/phpmailer/phpmailer/src/PHPMailer.php';
require './vendor/phpmailer/phpmailer/src/SMTP.php';
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

echo json_encode($record);

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

function emailBody($date, $time, $room)
{
    $m_time = timeToStr($time);
    $m_body = "<html><span>This is a meeting Reminder.</span><br><span>Date: $date</span><br><span>Time: $m_time</span><br><span>Room: $room</span><br><span>Member(s): <br>$member1<br>$member2<br>$member3<br>$member4<br><br>";
    $timeStrArr = array(
        "08:00", "09:00", "10:00", "11:00", "12:00",
        "13:00", "14:00", "15:00", "16:00", "17:00"
    );
    $dateArr = str_split($date);
    $date_append = "";
    foreach ($dateArr as $char) {
        if ($char != '-') {
            $date_append .= $char;
        }
    }
    $date_append .= 'T';

    $timeStr = array("080000", "090000", "100000", "110000", "120000", "130000", "140000", "150000", "160000", "170000");

    $start_time = "";
    $end_time = "";
    foreach ($time as $t) {

        //compute start_time end_time
        $start_time = $timeStr[$t];
        $end_time = $timeStr[$t + 1];
        $start_time_display = $timeStrArr[$t];
        $end_time_display = $timeStrArr[$t + 1];
        //url processing
        $m_body .= "<span>$start_time_display</span>-<span>$end_time_display  </span>";
        $template_url = "<a href=\"http://www.google.com/calendar/event?action=TEMPLATE&text=Meeting&dates=";
        $roomStr = "&location=";
        $roomStr .= $room;
        $template_url .= $date_append;
        $template_url .= $start_time;
        $template_url .= "/";
        $template_url .= $date_append;
        $template_url .= $end_time;
        $template_url .= "&details=none";
        $template_url .= $roomStr;
        $template_url .= "&trp=false";
        $template_url .= "&sf=true\">Add to Calendar</a>";
        $m_body .= $template_url;
        $m_body .= "<br>";
    }
    $m_body .= "</html>";

    return $m_body;
}


$mail = new PHPMailer();
$mail->SMTPSecure = "ssl";
$mail->Host = "smtp.gmail.com";
// $mail->Host = gethostbyname("smtp.gmail.com");
// $mail->SMTPOptions = array('ssl' => array('verify_peer_name' => false));
// $mail->SMTPDebug = 3;
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
$mail->Body = emailBody($date, $time, $room);
$mail->AddAddress($record->email);
if (!isset($member1)) {
    $mail->AddAddress($member1);
}
if (!isset($member2)) {
    $mail->AddAddress($member2);
}
if (!isset($member3)) {
    $mail->AddAddress($member3);
}
if (!isset($member4)) {
    $mail->AddAddress($member4);
}
$mail->Send();
// if (!$mail->Send()) {
//     echo "Mailer Error: " . $mail->ErrorInfo;
// }
unset($objDBController);
unset($mail);


