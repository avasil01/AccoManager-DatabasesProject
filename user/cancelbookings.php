<?php
// cancelBooking.php
session_start();

if (!isset($_SESSION['username'])) {
    echo 'User not logged in';
    exit;
}

if (!isset($_POST['bookingId'])) {
    echo 'Booking ID not provided';
    exit;
}

$serverName = "mssql.cs.ucy.ac.cy"; // Update with your server name
$connectionOptions = array(
    "Database" => "mpanae01",
    "Uid" => "mpanae01",
    "PWD" => "PVTmdk11" // Update with your password
);

// Establishes the connection
$conn = sqlsrv_connect($serverName, $connectionOptions);

if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
}

$bookingId = $_POST['bookingId'];
error_log("Received booking ID for cancellation: " . $bookingId);
// Call the stored procedure to cancel the booking
$sql = "EXEC [mpanae01].[CancelBooking] @bookingID = ?";

$params = array(
    array($bookingId, SQLSRV_PARAM_IN)
);

$stmt = sqlsrv_query($conn, $sql, $params);
if ($stmt === false) {
    $errors = sqlsrv_errors();
    echo 'Error cancelling booking: ';
    foreach($errors as $error) {
        echo "SQLSTATE: ".$error['SQLSTATE']."; ";
        echo "code: ".$error['code']."; ";
        echo "message: ".$error['message']."; ";
    }
    exit;
}


echo 'Booking cancelled successfully';
sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);
?>
