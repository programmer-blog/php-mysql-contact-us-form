<?php 

$host = "localhost";
$username = "root";
$password = "";
$dbanme = 'db-contactus';

$conn = new mysqli($host, $username, $password, $dbanme);

if($conn->connect_error) {
    die("Database connection failed. ". $conn->connect_error);
}
