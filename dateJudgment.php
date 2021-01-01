<?php

// 判斷日期

date_default_timezone_set('Asia/Taipei');
$selectDate = new DateTime($_POST['output']? $_POST['output']: "");
$timezone = date_default_timezone_get();

die($selectDate);



?>
