<?php

// Database connection details
$serverName = "mssql.cs.ucy.ac.cy"; // update this
$connectionOptions = array(
    "Database" => "mpanae01", // update this
    "Uid" => "mpanae01", // update this
    "PWD" => "PVTmdk11" // update this
);

// Establishes the connection
$conn = sqlsrv_connect($serverName, $connectionOptions);
if ($conn === false) {
    die(formatErrors(sqlsrv_errors()));
}

// Retrieve POST data
$input = file_get_contents('php://input');
$request = json_decode($input, true);

$accommodationTypeId = $request['accommodationTypeId'];
$startDate = $request['startDate'];
$endDate = $request['endDate'];
$username = $request['username']; // Assuming username is passed in the request

// Call the stored procedure
$sql = "EXEC [mpanae01].[AddBooking] @accommodationTypeID = ?, @startDate = ?, @endDate = ?, @username = ?";
$params = array($accommodationTypeId, $startDate, $endDate, $username);


$stmt = sqlsrv_query($conn, $sql, $params);
if ($stmt === false) {
    die(formatErrors(sqlsrv_errors()));
}

// Check if booking was successful
$rowsAffected = sqlsrv_rows_affected($stmt);
if ($rowsAffected > 0) {
    echo json_encode(array('status' => 'success', 'message' => 'Booking successfully added!'));
} else {
    echo json_encode(array('status' => 'error', 'message' => 'No available products for the specified date range.'));
}

// Close the statement and connection
sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);

// Function to format errors
function formatErrors($errors)
{
    $errorDetails = "SQL Error: ";
    foreach ($errors as $error) {
        $errorDetails .= "SQLSTATE: ".$error['SQLSTATE']."; ";
        $errorDetails .= "Code: ".$error['code']."; ";
        $errorDetails .= "Message: ".$error['message']."; ";
    }
    return $errorDetails;
}
?>
