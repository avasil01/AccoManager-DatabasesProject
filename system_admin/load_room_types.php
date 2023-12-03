<?php

$categoryId = $_POST['categoryID'];

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


$sql = "SELECT * FROM dbo.[ACCOMMODATION_TYPE] AT INNER JOIN dbo.[ACCOMMODATION] A ON A.legal_id = AT.accommodation INNER JOIN dbo.[ACCOMMODATION CATEGORY] AC ON AC.categoryID = A.categoryID WHERE AC.categoryID = ?; ;";
$params = array($categoryId);
$stmt = sqlsrv_query($conn, $sql, $params);

if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}


while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    echo '<label><input type="radio" name="roomType" value="' . htmlspecialchars($row['typeID']) . '"> ' . htmlspecialchars($row['typeName']) . '</label><br>';
}
?>