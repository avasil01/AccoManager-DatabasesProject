<?php

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


$input = file_get_contents('php://input');
$request = json_decode($input, true);

$accommodationId = $request['accommodationId'];
$serviceName = $request['serviceName'];

// Prepare and execute SQL query
$sql = "EXEC mpanae01.[AddService] ?, ?;"; // Update your stored procedure and parameters
$params = array($accommodationId, $serviceName);

$stmt = sqlsrv_query($conn, $sql, $params);
if ($stmt === false) {
    echo json_encode(["success" => false, "error" => formatErrors(sqlsrv_errors())]);
} else {
    echo json_encode(["success" => true]);
}

sqlsrv_close($conn);


?>
