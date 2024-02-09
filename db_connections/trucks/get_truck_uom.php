<?php 
include '../connection.php';

$truck_id = $_POST['truck_id'];
// Check if truck_id is set and not empty
if(isset($truck_id) && !empty($truck_id)){
    // Sanitize input to prevent SQL injection
    $truck_id = mysqli_real_escape_string($connection, $truck_id);

    // Fetch truck_uom based on the selected truck_id
    $query = "SELECT * FROM truck_uom WHERE truck_id = $truck_id";
    $ret_truck_uom = mysqli_query($connection, $query);
    
    if(mysqli_num_rows($ret_truck_uom) > 0){
        // Output options for UOM dropdown
        $options = '<option value="">Select UOM</option>';
        while($row = mysqli_fetch_assoc($ret_truck_uom)){
            $options .= '<option id="' . $row["uom_id"] . '" value="' . $row["uom"] . '">' . $row["uom"] . '</option>';
        }
        echo $options;
    } else {
        echo "<option value=''>No UOM Found</option>";
    }
} else {
    echo "<option value=''>Please Select Truck First</option>";
}

// Close database connection
mysqli_close($connection);

?>