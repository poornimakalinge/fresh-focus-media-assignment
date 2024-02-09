<?php 
include '../connection.php';

$staff_id = $_POST['staff_id'];
// Check if staff_id is set and not empty
if(isset($staff_id) && !empty($staff_id)){
    // Sanitize input to prevent SQL injection
    $staff_id = mysqli_real_escape_string($connection, $staff_id);

    // Fetch positions based on the selected pos_id
    $query = "SELECT * FROM positions WHERE staff_id = $staff_id";
    $ret_positions = mysqli_query($connection, $query);

    if(mysqli_num_rows($ret_positions) > 0){
        // Output options for positions dropdown
        $options = '<option value="">Select Position </option>';
        while($row = mysqli_fetch_assoc($ret_positions)){
            $options .= '<option id="' . $row["pos_id"] . '" value="' . $row["pos_name"] . '">' . $row["pos_name"] . '</option>';
        }
        echo $options;
    } else {
        echo "<option value=''>No Position Found</option>";
    }
} else {
    echo "<option value=''>Please Select Staff First</option>";
}

// Close database connection
mysqli_close($connection);

?>