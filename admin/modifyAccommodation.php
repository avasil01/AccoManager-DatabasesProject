<?php
// modifyAccommodation.php

$serverName = "mssql.cs.ucy.ac.cy";
$connectionOptions = array(
    "Database" => "mpanae01",
    "Uid" => "mpanae01",
    "PWD" => "PVTmdk11"
);

$conn = sqlsrv_connect($serverName, $connectionOptions);

if ($conn === false) {
    echo json_encode(['success' => false, 'error' => print_r(sqlsrv_errors(), true)]);
    exit;
}

$params = [
    $_POST["accommodationId"],
    $_POST["accommodationName"],
    $_POST["contactFullName"],
    $_POST["contactEmail"],
    $_POST["contactPhoneNumber"],
    $_POST["accommodationCategory"],
    $_POST["accommodationAddress"],
    $_POST["geographicCoordinates"],
    $_POST["town"],
    $_POST["username"]
];

$sql = "EXEC ModifyAccommodation ?, ?, ?, ?, ?, ?, ?, ?, ?, ?";
$stmt = sqlsrv_prepare($conn, $sql, $params);

if (!sqlsrv_execute($stmt)) {
    echo json_encode(['success' => false, 'error' => print_r(sqlsrv_errors(), true)]);
} else {
    echo json_encode(['success' => true]);
}

sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);
?>
