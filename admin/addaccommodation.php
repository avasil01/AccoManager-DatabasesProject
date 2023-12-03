<?php
// addaccommodation.php

// Database connection details
$serverName = "mssql.cs.ucy.ac.cy"; 
$connectionOptions = array(
    "Database" => "mpanae01", 
    "Uid" => "mpanae01", 
    "PWD" => "PVTmdk11" 
);


$conn = sqlsrv_connect($serverName, $connectionOptions);
if ($conn === false) {
    die(formatErrors(sqlsrv_errors()));
}

// Retrieve POST data as JSON
$input = file_get_contents('php://input');
$request = json_decode($input, true);

// Extract data from JSON object
$legal_id = $request['accommodationId'];
$accommodationName = $request['accommodationName'];
$contactFullName = $request['contactFullName'];
$contactEmail = $request['contactEmail'];
$contactPhoneNumber = $request['contactPhoneNumber'];
$categoryName = $request['accommodationCategory'];
$address = $request['accommodationAddress'];
$coordinates = $request['geographicCoordinates'];
$town = $request['town'];
$username = $request['username']; 

// Prepare and execute SQL query
$sql = "EXEC dbo.[AddAccommodation] ?, ?, ?, ?, ?, ?, ?, ?, ?, ?;";
$params = array($legal_id, $accommodationName, $contactFullName, $contactEmail, $contactPhoneNumber, $categoryName, $address, $coordinates, $username, $town );

$stmt = sqlsrv_query($conn, $sql, $params);
if ($stmt === false) {
    die(formatErrors(sqlsrv_errors()));
} else {
    echo json_encode(["success" => "Accommodation added successfully"]);
}


sqlsrv_close($conn);


function formatErrors($errors) {
    
}
?>
