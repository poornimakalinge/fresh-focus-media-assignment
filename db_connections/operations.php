<?php
// Establish database connection
include './connection.php';

// Check if the connection was successful
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

foreach ($_POST as $key => $value) {
    $_POST[urldecode($key)] = urldecode($value);
}
// Retrieve form data
// Sanitize and validate input as needed
// Example:
$customer_name = $_POST['customer_name'];
$job_name = $_POST['job_name'];
$status = $_POST['status'];
$location_name = $_POST['location/lsd'];
$ordered_by = $_POST['ordered_by'];
$date = $_POST['date'];
$area_field = $_POST['area/field'];
$description = $_POST['description'];
$labour_subtotal = $_POST['labour_subtotal'];
$labours_data = $_POST['labours_data'];
$truck_subtotal = $_POST['truck_subtotal'];
$trucks_data = $_POST['trucks_data'];
$miscell_subtotal = $_POST['miscell_subtotal'];
$miscellaneous_data = $_POST['miscellaneous_data'];

// Prepare and execute SQL statement to insert data into the database
$field_ticket_details_query = "INSERT INTO field_ticket_details (customer_name, job_name, status, location_name, ordered_by, date, area_field, description, labour_subtotal, labours_data, truck_subtotal, trucks_data, miscell_subtotal, miscellaneous_data) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $connection->prepare($field_ticket_details_query);

// Check if preparing the statement was successful
if (!$stmt) {
    die("SQL error: " . $connection->error);
}

// Bind parameters
$stmt->bind_param('ssssssssisisis', $customer_name, $job_name, $status, $location_name, $ordered_by, $date, $area_field, $description, $labour_subtotal, $labours_data, $truck_subtotal, $trucks_data, $miscell_subtotal, $miscellaneous_data);

// Execute the statement
$stmt->execute();

// Check if the execution was successful
if ($stmt->affected_rows > 0) {
    echo "Field ticket details has been saved"; // or any appropriate response
} else {
    echo "Error: " . $stmt->error;
}

// Close statement and connection
$stmt->close();
$connection->close();

// Respond to the AJAX request
echo "Field ticket details has been saved";

?>


