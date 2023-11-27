<?php

$serverName = "mssql.cs.ucy.ac.cy";
$connectionOptions = array(
    "Database" => "mpanae01",
    "Uid" => "mpanae01",
    "PWD" => "PVTmdk11"
);

// Create connection
$conn = sqlsrv_connect($serverName, $connectionOptions);

// Check connection
if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
} else {
    // Execute query
    // Retrieve data from the AJAX request
$data = json_decode(file_get_contents("php://input"), true);

// Prepare the stored procedure call
$tsql = "{call [mpanae01].[SearchProducts](?, ?, ?, ?)}";
$params = array(
    array($data["location"], SQLSRV_PARAM_IN),
    array($data["startDate"], SQLSRV_PARAM_IN),
    array($data["endDate"], SQLSRV_PARAM_IN),
    array($data["guests"], SQLSRV_PARAM_IN)
);

$stmt = sqlsrv_query($conn, $tsql, $params);
if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

// Fetch results and output as JSON
$results = array();
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $results[] = $row;
}
echo json_encode($results);

// Close the statement and connection
sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);
    }

    // Clean up resources
    sqlsrv_free_stmt($result);
    sqlsrv_close($conn);
}
?>