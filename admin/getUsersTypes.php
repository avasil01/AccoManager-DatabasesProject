<?php

$serverName = "mssql.cs.ucy.ac.cy"; 
$connectionOptions = array(
    "Database" => "mpanae01", 
    "Uid" => "mpanae01", 
    "PWD" => "PVTmdk11" 
);

$conn = sqlsrv_connect($serverName, $connectionOptions);
if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
}

$input = file_get_contents('php://input');
$data = json_decode($input, true);

if (!isset($data['username'])) {
    die('Username is required');
}

$query = "SELECT typeID, typeName FROM dbo.[ACCOMMODATION_TYPE] AT INNER JOIN dbo.[ACCOMMODATION] A ON AT.accommodation = A.legal_id INNER JOIN dbo.[USER] U ON U.id = A.owner WHERE U.username = ?;";
$params = array($data['username']);

$stmt = sqlsrv_query($conn, $query, $params);
if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

$types = array();
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $types[] = array(
        "AccommodationTypeID" => $row['typeID'],
        "Name" => $row['typeName']
    );
}

header('Content-Type: application/json');
echo json_encode($types);
?>
