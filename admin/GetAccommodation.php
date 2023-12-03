<?php
// GetAccommodation.php

// Start the session
session_start();

// Check if the user is logged in, otherwise redirect to login page
if (!isset($_SESSION['username'])) {
    header('Location: ../login.php');
    exit();
}

$serverName = "mssql.cs.ucy.ac.cy"; // update this
$connectionOptions = array(
    "Database" => "mpanae01", // update this
    "Uid" => "mpanae01", // update this
    "PWD" => "PVTmdk11" // update this
);


// Create database connection
$conn = sqlsrv_connect($serverName, $connectionOptions);

// Check connection
if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
}

// Check if Accommodation ID is set in the GET request
if(isset($_GET['accommodationId'])) {
    $accommodationId = $_GET['accommodationId'];

    // Prepare the SQL statement to prevent SQL injection
    $sql = "SELECT * FROM dbo.[ACCOMMODATION] A INNER JOIN dbo.[CONTACT PEOPLE] CP ON CP.phone_number = A.contact_number INNER JOIN dbo.[ACCOMMODATION CATEGORY] AC ON AC.categoryID = A.categoryID WHERE legal_id = ?;";
    $params = array($accommodationId);
    $stmt = sqlsrv_query($conn, $sql, $params);

    // Check for errors in executing the statement
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    // Fetch data
    $data = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

    // Close statement
    sqlsrv_free_stmt($stmt);

    // Close connection
    sqlsrv_close($conn);

    // Return data in JSON format
    echo json_encode($data);
} else {
    echo json_encode(array("error" => "Accommodation ID not provided"));
}

?>
