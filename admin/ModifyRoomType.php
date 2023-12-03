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

$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, true); 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $roomType = $input['roomTypeModify'];
    $maxGuests = $input['maxGuestsModify'];
    $size = $input['sizeModify'];
    $bedrooms = $input['bedroomsModify'];
    $accommodationId = $input['accommodationIdModify'];
    $availableRooms = $input['availableroomsModify'];
    $roomName = $input['roomNameModify'];

    $sql = "EXEC dbo.ModifyAccommodationType ?, ?, ?, ?, ?, ?, ?;";
    $params = array($roomType, $roomName, $maxGuests, $bedrooms, $availableRooms, $size, $accommodationId);

    $stmt = sqlsrv_query($conn, $sql, $params);
    if ($stmt) {
        echo json_encode(array("success" => true));
    } else {
        echo json_encode(array("error" => sqlsrv_errors()));
    }
}

sqlsrv_close($conn);
?>
