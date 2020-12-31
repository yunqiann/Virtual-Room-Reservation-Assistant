
<?php
header("Content-Type: application/json");


$date = $_POST["date"];
$time = $_POST["time"];
// if (isset($_POST['selected_date'])) {
//     $date = $_POST('selected_date');
// } else $date;
// if (isset($_POST['time'])) {
//     $time = $_POST['time'];
// } else $time;
// if (isset($_POST['room'])) {
//     $room = $_POST['room'];
// } else $room;
// if (isset($_POST['host-email'])) {
//     $email = $_POST['host-email'];
// } else $email;
// if (isset($_POST['member-email1'])) {
//     $member1 = $_POST("member-email1");
// } else $member1;
// if (isset($_POST['member-email2'])) {
//     $member2 = $_POST("member-email2");
// } else $member2;
// if (isset($_POST['member-email3'])) {
//     $member3 = $_POST("member-email3");
// } else $member3;
// if (isset($_POST['member-email4'])) {
//     $member4 = $_POST("member-email4");
// } else $member4;

$response = array(
    'date' => $date,
    'time' => $time,
    // 'room' => $room,
    // 'email' => $email,
    // 'member1' => $member1,
    // 'member2' => $member2,
    // 'member3' => $member3,
    // 'member4' => $member4
);
echo json_encode($response);
?>