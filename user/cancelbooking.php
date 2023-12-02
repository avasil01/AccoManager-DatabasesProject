<?php
// cancelbooking.php

// Database connection details
$serverName = "mssql.cs.ucy.ac.cy"; // update this
$connectionOptions = array(
    "Database" => "mpanae01", // update this
    "Uid" => "mpanae01", // update this
    "PWD" => "PVTmdk11" // update this
);

// Establish the connection
$conn = sqlsrv_connect($serverName, $connectionOptions);
if ($conn === false) {
    die(formatErrors(sqlsrv_errors()));
}

// Function to format errors
function formatErrors($errors)
{
    $errorDetails = "SQL Error: ";
    foreach ($errors as $error) {
        $errorDetails .= "SQLSTATE: " . $error['SQLSTATE'] . "; ";
        $errorDetails .= "Code: " . $error['code'] . "; ";
        $errorDetails .= "Message: " . $error['message'] . "; ";
    }
    return $errorDetails;
}

// Check for POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bookingID = isset($_POST['bookingID']) ? $_POST['bookingID'] : null;

    // Check if bookingID is provided
    if ($bookingID === null) {
        echo json_encode(["error" => "No booking ID provided"]);
        exit();
    }

    // Prepare SQL query
    $sql = "EXEC mpanae01.CancelBooking ?;";
    $params = array($bookingID);

    // Execute the query
    $stmt = sqlsrv_query($conn, $sql, $params);
    if ($stmt === false) {
        die(formatErrors(sqlsrv_errors()));
    } else {
        echo json_encode(["success" => "Booking cancelled successfully"]);
    }
} else {
    // Handle non-POST requests
    echo json_encode(["error" => "Invalid request method"]);
}

// Close the connection
sqlsrv_close($conn);
?>
