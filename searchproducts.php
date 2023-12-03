<?php
header('Content-Type: application/json');

$serverName = "mssql.cs.ucy.ac.cy";
$connectionOptions = array(
    "Database" => "mpanae01",
    "Uid" => "mpanae01",
    "PWD" => "PVTmdk11"
);


$conn = sqlsrv_connect($serverName, $connectionOptions);
if ($conn === false) {
    error_log(print_r(sqlsrv_errors(), true));
    echo json_encode(array("error" => "Connection failed"));
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);

$sql = "EXEC [mpanae01].[SearchProducts] @Location=?,@StartDate = ?,@EndDate = ?,@Guests = ?;";
$params = array(
    $data["location"],
    $data["startDate"],
    $data["endDate"],
    $data["guests"]
);


$stmt = sqlsrv_query($conn, $sql, $params);
if ($stmt === false) {
    error_log(print_r(sqlsrv_errors(), true));
    echo json_encode(array("error" => "Statement execution failed" , "details" => sqlsrv_errors()));
    exit;
}

$results = array();
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $results[] = $row;
}

echo json_encode($results);

sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);
?>