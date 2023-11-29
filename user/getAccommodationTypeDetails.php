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

$startDate = $request['startDate'];
$endDate = $request['endDate'];
$guests = $request['guests'];
$accommodationLegalId = $request['accommodationLegalId'];

// Call the stored procedure
$sql = "EXEC GetAccommodationTypeDetails @StartDate = ?, @EndDate = ?, @Guests = ?, @AccommodationLegalId = ?";
$params = array($startDate, $endDate, $guests, $accommodationLegalId);

$stmt = sqlsrv_query($conn, $sql, $params);
if ($stmt === false) {
    die(formatErrors(sqlsrv_errors()));
}

// Fetch results
$result = array();
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $result[] = $row;
}

// Close the statement and connection
sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);

// Return data as JSON
header('Content-Type: application/json');
echo json_encode($result);

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

?>
