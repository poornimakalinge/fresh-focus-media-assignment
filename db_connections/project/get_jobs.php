<?php 
include '../connection.php';

$customer_id = $_POST['customer_id'];
// Check if customer_id is set and not empty
if(isset($customer_id) && !empty($customer_id)){
    // Sanitize input to prevent SQL injection
    $customer_id = mysqli_real_escape_string($connection, $customer_id);

    // Fetch jobs based on the selected customer_id
    $query = "SELECT * FROM jobs WHERE customer_id = $customer_id";
    $ret_jobs = mysqli_query($connection, $query);

    if(mysqli_num_rows($ret_jobs) > 0){
        // Output options for Jobs dropdown
        $options = '<option value="">Select Job Name</option>';
        while($row = mysqli_fetch_assoc($ret_jobs)){
            $options .= '<option id="' . $row["job_id"] . '" value="' . $row["job_name"] . '">' . $row["job_name"] . '</option>';
        }
        echo $options;
    } else {
        echo "<option value=''>No Jobs Found</option>";
    }
} else {
    echo "<option value=''>Please Select Customer First</option>";
}

// Close database connection
mysqli_close($connection);

?>