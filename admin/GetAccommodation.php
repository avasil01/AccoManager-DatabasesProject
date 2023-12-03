<?php
// GetAccommodation.php

session_start();

if (!isset($_SESSION['username'])) {
    header('Location: ../login.php');
    exit();
}

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

if(isset($_GET['accommodationId'])) {
    $accommodationId = $_GET['accommodationId'];

    $sql = "SELECT * FROM dbo.[ACCOMMODATION] A INNER JOIN dbo.[CONTACT PEOPLE] CP ON CP.phone_number = A.contact_number INNER JOIN dbo.[ACCOMMODATION CATEGORY] AC ON AC.categoryID = A.categoryID WHERE legal_id = ?;";
    $params = array($accommodationId);
    $stmt = sqlsrv_query($conn, $sql, $params);

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    $data = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

    sqlsrv_free_stmt($stmt);

    sqlsrv_close($conn);

    echo json_encode($data);
} else {
    echo json_encode(array("error" => "Accommodation ID not provided"));
}

?>
