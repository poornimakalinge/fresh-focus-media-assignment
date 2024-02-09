<?php
include '../connection.php';

$job_id = $_POST['job_id'];
// Check if job_id is set and not empty
if(isset($job_id) && !empty($job_id)){
    // Sanitize input to prevent SQL injection
    $job_id = mysqli_real_escape_string($connection, $job_id);

    // Fetch locations based on the selected job_id
    $query = "SELECT * FROM locations WHERE job_id = $job_id";
    $ret_locations = mysqli_query($connection, $query);

    if(mysqli_num_rows($ret_locations) > 0){
        // Output options for locations dropdown
        $options = '<option value="">Select Location/LSD</option>';
        while($row = mysqli_fetch_assoc($ret_locations)){
            $options .= '<option id="' . $row["location_id"] . '" value="' . $row["location_name"] . '">' . $row["location_name"] . '</option>';
        }
        echo $options;
    } else {
        echo "<option value=''>No Locations Found</option>";
    }
} else {
    echo "<option value=''>Please Select Job & Customer First</option>";
}

// Close database connection
mysqli_close($connection);
?>