<?php
include '../connection.php';

$uom_id = $_POST['uom_id'];

// Check if uom_id is set and not empty
if(isset($uom_id) && !empty($uom_id)){
    // Sanitize input to prevent SQL injection
    $uom_id = mysqli_real_escape_string($connection, $uom_id);

    // Fetch truck rates based on the selected uom_id
    $query = "SELECT * FROM truck_rates WHERE uom_id = $uom_id";
    $ret_truck_rates = mysqli_query($connection, $query);

    if(mysqli_num_rows($ret_truck_rates) > 0){
        // Fetch the data into an array
        $data = array();
        while($row = mysqli_fetch_assoc($ret_truck_rates)){
            $data[] = $row;
        }
        echo json_encode($data);
    } else {
        echo json_encode(array('error' => 'No data found'));
    }
}

// Close database connection
mysqli_close($connection);

?>