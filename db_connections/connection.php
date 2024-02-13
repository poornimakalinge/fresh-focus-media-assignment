<?php

$project_status_items = ['Active', 'Pending', 'Closed'];

//using XAMPP application & running on local servers
// $host = 'localhost';
// $dbname = 'field_ticket_db';
// $username = 'root';
// $password = '';

// to run on infinity free hosting server
$host = 'sql200.infinityfree.com';
$dbname = 'if0_35971502_field_ticket_db';
$username = 'if0_35971502';
$password = 'zNOmF5u2D0r2T';
$domainname = 'field-ticket.great-site.net';

// these params should be sent in order else add variables & it passes as object 
$connection = new mysqli($host, $username, $password, $dbname);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

mysqli_select_db($connection, $dbname);

?>