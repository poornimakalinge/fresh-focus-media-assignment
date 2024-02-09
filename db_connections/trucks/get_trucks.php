<?php 
include '../connection.php';

// Query to retrieve trucks
$get_trucks_query = "SELECT * FROM trucks";
$ret_trucks = mysqli_query($connection, $get_trucks_query);

if (mysqli_num_rows($ret_trucks) > 0) {
    $options = '<option value="">Select Truck</option>';
    while($row = mysqli_fetch_assoc($ret_trucks)) {
        $options .= '<option id="' . $row["truck_id"] . '" value="' . $row["truck_name"] . '">' . $row["truck_name"] . '</option>';
    }
    echo $options;
} else {
    echo '<option value="">No Truck Found</option>';
}

// Close database connection
mysqli_close($connection);

?>