<?php
session_start();

// Include database connection details
// Database connection details
$serverName = "mssql.cs.ucy.ac.cy"; // update this
$connectionOptions = array(
    "Database" => "mpanae01", // update this
    "Uid" => "mpanae01", // update this
    "PWD" => "PVTmdk11" // update this
);

// Establishes the connection
// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // User not logged in, return an error
    header('Content-Type: application/json');
    echo json_encode(array("error" => "User not logged in"));
    exit();
}

$username = $_SESSION['username'];

// Establishes the connection
$conn = sqlsrv_connect($serverName, $connectionOptions);
if ($conn === false) {
    die(formatErrors(sqlsrv_errors()));
}

// SQL to get user bookings
$sql = "SELECT * FROM dbo.[BOOKING] B INNER JOIN dbo.[USER] U ON U.id = B.userID WHERE U.username = ? AND B.Active = 1;"; // Update 'Bookings' and 'Username' as per your table and column names
$params = array($username);

$stmt = sqlsrv_query($conn, $sql, $params);
if ($stmt === false) {
    die(formatErrors(sqlsrv_errors()));
}

// Fetch results
$bookings = array();
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $bookings[] = $row;
}

// Close the statement and connection
sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);

// Return data as JSON
header('Content-Type: application/json');
echo json_encode($bookings);

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
