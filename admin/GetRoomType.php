<?php
// GetRoomType.php

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

if (isset($_POST['roomType']) && isset($_POST['username'])) {
    $roomType = $_POST['roomType'];
    $username = $_POST['username'];

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
