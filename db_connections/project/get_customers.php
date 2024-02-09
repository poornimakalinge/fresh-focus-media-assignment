<?php 
include '../connection.php';

// Query to retrieve customers
$get_customers_query = "SELECT * FROM customers";
$ret_customers = mysqli_query($connection, $get_customers_query);

if (mysqli_num_rows($ret_customers) > 0) {
    $options = '<option value="">Select Customer Name</option>';
    while($row = mysqli_fetch_assoc($ret_customers)) {
        $options .= '<option id="' . $row["customer_id"] . '" value="' . $row["customer_name"] . '">' . $row["customer_name"] . '</option>';
    }
    echo $options;
} else {
    echo '<option value="">No Customers Found</option>';
}

// Close database connection
mysqli_close($connection);

?>