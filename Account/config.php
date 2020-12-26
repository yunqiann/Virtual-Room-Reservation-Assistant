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
}
