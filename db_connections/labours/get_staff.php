<?php 
include '../connection.php';

// Query to retrieve staff
$get_staff_query = "SELECT * FROM staff";
$ret_staff = mysqli_query($connection, $get_staff_query);

if (mysqli_num_rows($ret_staff) > 0) {
    $options = '<option value="">Select Staff</option>';
    while($row = mysqli_fetch_assoc($ret_staff)) {
        $options .= '<option id="' . $row["staff_id"] . '" value="' . $row["staff_name"] . '">' . $row["staff_name"] . '</option>';
    }
    echo $options;
} else {
    echo '<option value="">No Staff Found</option>';
}

// Close database connection
mysqli_close($connection);

?>