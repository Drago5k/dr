<?php
$servername = "localhost";
$username = "Admin";
$password = "";
$dbname = "Baza";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
	die("Połączenie nieudane: " . $conn->connect_error);
}
mysqli_set_charset($conn, "utf8");
$result = $conn->query("UPDATE " . utf8_decode($_POST["table"]) . " set " . $_POST["column"] . " = '".$_POST["editval"]."' WHERE ID=".$_POST["id"]);
echo $result;
?>