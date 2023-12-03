<?php
// GetRoomType.php

// Database connection parameters
$serverName = "mssql.cs.ucy.ac.cy"; // update this
$connectionOptions = array(
    "Database" => "mpanae01", // update this
    "Uid" => "mpanae01", // update this
    "PWD" => "PVTmdk11" // update this
);

// Connect to the database
$conn = sqlsrv_connect($serverName, $connectionOptions);
if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
}

// Check if both Room Type and Username are provided
if (isset($_POST['roomType']) && isset($_POST['username'])) {
    $roomType = $_POST['roomType'];
    $username = $_POST['username'];

    // Adjust the SQL query to include the username in the criteria
    // This example assumes a relationship between the accommodation type and the user.
    // Update the JOIN and WHERE clauses according to your database schema.
    $sql = "SELECT * FROM dbo.ACCOMMODATION_TYPE at
            JOIN dbo.ACCOMMODATION a ON at.accommodation = a.legal_id
            JOIN dbo.[USER] u ON a.owner = u.id
            WHERE at.typeName = ? AND u.username = ?";
    $params = array($roomType, $username);
    $stmt = sqlsrv_query($conn, $sql, $params);

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    $data = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    echo json_encode($data);

    sqlsrv_free_stmt($stmt);
} else {
    echo json_encode(array("error" => "Required parameters not provided"));
}

sqlsrv_close($conn);
?>
