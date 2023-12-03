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
    die(json_encode(array("error" => sqlsrv_errors())));
}


$input = file_get_contents('php://input');
$data = json_decode($input, true);

// Perform your validation and sanitation on $data here

// Prepare and execute your SQL statement
// For example:
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
