<?php

$username = "shopowner";
$host = "localhost";
$password = "supersecretpassword";
$db = "shop";
$table = "products";

$conn = new mysqli($host, $username, $password, $db);
if ($conn->connect_error) {
	die("Connection failed: ".$conn->connect_error);
}

?>