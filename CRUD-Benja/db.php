<?php
$host = "localhost";
$db = "benjamin_contreras_db1";
$user = "benjamin_contreras";
$pass = "benjamin_contreras2025";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
  die("Error de conexión: " . $conn->connect_error);
}
?>