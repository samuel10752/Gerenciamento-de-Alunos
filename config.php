<?php
$servername = "localhost";
$username = "root";
$password = "@Scb2004457";
$dbname = "escola";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
?>