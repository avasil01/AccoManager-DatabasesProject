<?php
$serverName = "mssql.cs.ucy.ac.cy"; 
$connectionOptions = array(
    "Database" => "mpanae01", 
    "Uid" => "mpanae01", 
    "PWD" => "PVTmdk11" 
);


$conn = sqlsrv_connect($serverName, $connectionOptions);
if ($conn === false) {
    die(json_encode(array("error" => sqlsrv_errors())));
}


$input = file_get_contents('php://input');
$data = json_decode($input, true);

$query = "EXEC mpanae01.AddProduct ?, ?, ?, ?, ?, ?, ?, ?;";
$params = array(
    $data['productDate'],
    $data['productRoomPrice'],
    $data['productMeals'],
    $data['productPolicy'],
    $data['productRefundPercentage'],
    $data['productPenaltyPercentage'],
    $data['productDiscountPercentage'],
    $data['productAccommodationTypeId']
);

$stmt = sqlsrv_query($conn, $query, $params);

if ($stmt === false) {
    die(json_encode(array("error" => sqlsrv_errors())));
} else {
    echo json_encode(["success" => "Product added successfully"]);
}


sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);
?>
