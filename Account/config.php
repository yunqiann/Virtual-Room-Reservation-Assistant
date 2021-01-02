<?php
class DBController
{
	private $host = "localhost";
	private $user = "yunqian";
	private $password = "123456";
	private $database = "Test";
	private $conn = null;

	function __construct()
	{
		$this->connectDB();
		$this->selectDB();
	}

	function __destruct()
	{
		mysqli_close($this->conn);
	}

	function connectDB()
	{
		$this->conn = mysqli_connect($this->host, $this->user, $this->password);
		if ($this->conn === false) {
			die("ERROR: Could not connect. " . mysqli_connect_error());
		}
	}

	function selectDB()
	{
		$result = mysqli_select_db($this->conn, $this->database);
		if ($result === false) {
			die("ERROR: Could not connect database.");
		}
	}

	function getUserByOAuthId($oauth_user_id)
	{
		$query = "SELECT * FROM USERS WHERE id = '$oauth_user_id'";
		$result = mysqli_query($this->conn, $query);
		if (!empty($result)) {
			$existing_member = mysqli_fetch_assoc($result);
			return $existing_member;
		}
	}

	function insertOAuthUser($userData)
	{
		$query = "INSERT INTO USERS VALUES ('$userData->id', '$userData->email')";
		$result = mysqli_query($this->conn, $query);
		if ($result === false) {
			die("ERROR: MySQL Insert");
		}
	}

	function insertReocrd($record)
	{
		$id = $this->SearchuserID($record->email);
		$query = "INSERT INTO Record VALUES ('$record->date', '$record->time',
				'$id', '$record->room', '$record->member1',
				'$record->member2', '$record->member3', '$record->member4')";
		$result = mysqli_query($this->conn, $query);
		if ($result === false) {
			die("ERROR: MySQL Insert");
		}
		return $id;
	}

	function deleteReocrd($record)
	{
		$query = "DELETE FROM Record WHERE useDate='$record->date' and roomID='$record->room' and timeSlot='$record->time'";
		$result = mysqli_query($this->conn, $query);
		if ($result === false) {
			die("ERROR: MySQL Delete");
		}
		// die($result);
	}

	function SearchRecord($email)
	{
		$id = $this->SearchuserID($email);
		$query = "SELECT DATE_FORMAT(useDate, '%Y/%m/%d'), timeSlot, roomID, member1, member2, member3, member4 FROM Record where userID='$id' or member1='$email' or member2='$email' or member3='$email' or member4='$email'";
		if ($result = mysqli_query($this->conn, $query)) {
			$row = mysqli_fetch_all($result);
		} else die("Error:" . mysqli_error($this->con));
		return $row;
	}

	function SearchuserID($email)
	{
		$query = "SELECT id FROM `USERS` WHERE email='$email'";
		if ($result = mysqli_query($this->conn, $query)) {
			$row = mysqli_fetch_row($result);
			$id = $row[0];
		} else die("Error:" . mysqli_error($this->conn));

		return $id;
	}

	function SearchuserEmail($record)
	{
		$query = "SELECT email FROM USERS WHERE id=(SELECT userID FROM Record WHERE useDate='$record->date' and timeSlot='$record->time' and roomID='$record->room')";
		if ($result = mysqli_fetch_row($this->conn, $query)) {
			$row = mysqli_fetch_row($result);
		}
		return $row[0];
	}

	# 查詢 Room 什麼時間被使用
	function SearchRoomTime($record)
	{
		//查詢是否存在
		$query = "SELECT EXISTS(SELECT * from Record WHERE useDate='$record->date' and timeSlot='$record->time' and roomID='$record->room')";
		if ($result = mysqli_query($this->conn, $query)) {
			$useBool =  mysqli_fetch_row($result);
		} else die("Error:" . mysqli_error($this->con));
		return $useBool[0];
	}
}
