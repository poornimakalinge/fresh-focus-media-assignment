<?php

$project_status_items = ['Active', 'Pending', 'Closed'];

$host = 'localhost';
$dbname = 'field_ticket_db';
$username = 'root';
$password = '';

// these params should be sent in order else add variables & it passes as object 
$connection = new mysqli($host, $username, $password, $dbname);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

mysqli_select_db($connection, $dbname);

?>