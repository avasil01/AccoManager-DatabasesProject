<?php

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


$input = file_get_contents('php://input');
$request = json_decode($input, true);

$accommodationId = $request['accommodationId'];
$serviceName = $request['serviceName'];

$sql = "EXEC mpanae01.[AddService] ?, ?;"; 
$params = array($accommodationId, $serviceName);

$stmt = sqlsrv_query($conn, $sql, $params);
if ($stmt === false) {
    echo json_encode(["success" => false, "error" => formatErrors(sqlsrv_errors())]);
} else {
    echo json_encode(["success" => true]);
}

sqlsrv_close($conn);


?>
