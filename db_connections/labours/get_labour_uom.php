<?php
include '../connection.php';

$pos_id = $_POST['pos_id'];

// Check if pos_id is set and not empty
if(isset($pos_id) && !empty($pos_id)){
    // Sanitize input to prevent SQL injection
    $pos_id = mysqli_real_escape_string($connection, $pos_id);

    // Fetch labour uom based on the selected pos_id
    $query = "SELECT * FROM labours_uom WHERE pos_id = $pos_id";
    $ret_labour_uom = mysqli_query($connection, $query);
    print_r($ret_labour_uom);
    if(mysqli_num_rows($ret_labour_uom) > 0){
        // Output options for UOM dropdown
        $options = '<option value="">Select UOM</option>';
        while($row = mysqli_fetch_assoc($ret_labour_uom)){
            $options .= '<option id="' . $row["uom_id"] . '" value="' . $row["uom"] . '">' . $row["uom"] . '</option>';
        }
        echo $options;
    } else {
        echo "<option value=''>No UOM Found</option>";
    }
} else {
    echo "<option value=''>Please Select Position & Staff First</option>";
}

// Close database connection
mysqli_close($connection);

?>