<?php

// Database connection
$serverName = "mssql.cs.ucy.ac.cy";
$connectionOptions = array(
    "Database" => "mpanae01",
    "Uid" => "mpanae01",
    "PWD" => "PVTmdk11"
);
// Connect to the database
$conn = sqlsrv_connect($serverName, $connectionOptions);
if ($conn === false) {
    die(json_encode(array("error" => sqlsrv_errors())));
}

// Retrieve JSON data from POST request
$input = file_get_contents('php://input');
$data = json_decode($input, true);

// SQL query
$sql = "EXEC mpanae01.AddAccommodationType ?,?,?,?,?,?;";

// Prepare and execute the query
$stmt = sqlsrv_prepare($conn, $sql, array(
    $data['roomType'], 
    $data['maxGuests'], 
    $data['bedrooms'], 
    $data['availablerooms'], 
    $data['size'], 
    $data['accommodationId']
));

if ($stmt === false) {
    die(formatErrors(sqlsrv_errors()));
} else {
    echo json_encode(["success" => "Room Type added successfully"]);
}

// Close the statement and connection
sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);

?>
