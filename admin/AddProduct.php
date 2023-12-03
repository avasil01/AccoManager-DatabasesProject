<?php
// ... Include your database connection code ...

$input = file_get_contents('php://input');
$data = json_decode($input, true);

// Perform your validation and sanitation on $data here

// Prepare and execute your SQL statement
// For example:
$query = "EXEC mpanae01.AddProduct ?, ?, ?, ?, ?, ?";
$params = array(
    $data['productDate'],
    $data['productRoomPrice'],
    $data['productMeals'],
    $data['productPolicy'],
    $data[' productRefundPercentage'],
    $data['productPenaltyPercentage'],
    $data['productDiscountPercentage'],
    $data['productAccommodationTypeId']
);

$stmt = sqlsrv_query($conn, $query, $params);
if ($stmt === false) {
    // Handle query error
    echo json_encode(array("success" => false, "error" => sqlsrv_errors()));
} else {
    // Success response
    echo json_encode(array("success" => true));
}
?>
