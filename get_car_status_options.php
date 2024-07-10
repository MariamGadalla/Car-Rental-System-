<?php

include('session_admin.php');

// Retrieve the plate ID from the AJAX request
$plateID = $_GET['plateID'];

// Perform a database query to get the relevant car status options based on the plate ID
// Replace this with your actual database query
$query = "SELECT DISTINCT car_status FROM car WHERE plate_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('s', $plateID);
$stmt->execute();
$stmt->store_result();

// Fetch the results
$options = '';

if ($stmt->num_rows > 0) {
    $stmt->bind_result($currentStatus);

    while ($stmt->fetch()) {
        // Determine the options based on the current status
        $select = '
        <option value="" disabled selected>Select Car Status</option>';
        $availableOption = '';
        $outOfServiceOption = '';

        if ($currentStatus == 'Available') {
            $outOfServiceOption = '<option value="Out of Service">Out of Service</option>';
        } elseif ($currentStatus == 'Out of Service') {
            $availableOption = '<option value="Available">Available</option>';
        } elseif ($currentStatus == 'Rented') {
            $availableOption = '<option value="Available">Available</option>';
            $outOfServiceOption = '<option value="Out of Service">Out of Service</option>';
        }

        // Concatenate the options to the $options string
        $options .= $select . $availableOption . $outOfServiceOption;
    }
} else {
    // If no results, provide a default option
    $options = '<option value="" disabled selected>No options available</option>';
}

// Return the generated options
echo $options;
?>
