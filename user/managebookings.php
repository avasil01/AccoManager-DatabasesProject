<?php
// managebookings.php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['username'])) {
    echo json_encode(['error' => 'User not logged in']);
    exit;
}

$serverName = "mssql.cs.ucy.ac.cy"; // Update with your server name
$connectionOptions = array(
    "Database" => "mpanae01", // Update with your database name
    "Uid" => "mpanae01", // Update with your username
    "PWD" => "PVTmdk11" // Update with your password
);

// Establishes the connection
$conn = sqlsrv_connect($serverName, $connectionOptions);

if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
}

$user_username = $_SESSION['username'];
$sql = "EXEC [mpanae01].[GetAllBookings] @username = ?";


$params = array(
    array($user_username, SQLSRV_PARAM_IN)
);


$stmt = sqlsrv_query($conn, $sql, $params);
if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

$bookings = [];
// while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
//     $bookings[] = $row;
// }
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    // Check if startDate and endDate are DateTime objects
    if ($row['startDate'] instanceof DateTime) {
        $row['startDate'] = $row['startDate']->format('Y-m-d');
    }
    if ($row['endDate'] instanceof DateTime) {
        $row['endDate'] = $row['endDate']->format('Y-m-d');
    }

    // If they are strings, you can leave them as is or format as needed

    $bookings[] = $row;
}


echo json_encode($bookings);

sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);
?>
