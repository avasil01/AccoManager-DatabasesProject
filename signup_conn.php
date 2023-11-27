<?php

$serverName = "mssql.cs.ucy.ac.cy";
$connectionOptions = array(
    "Database" => "mpanae01",
    "Uid" => "mpanae01",
    "PWD" => "PVTmdk11"
);


// Connect to the database
$conn = sqlsrv_connect($serverName, $connectionOptions);

if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Extract data from request
    $fullName = $_POST['fullName'];
    $username = $_POST['username'];
    $password = $_POST['password']; // Remember to hash the password
    $sex = $_POST['sex'];
    $birthday = $_POST['birthday'];
    $typeOfUser = $_POST['TypeOfUser'];

    // Prepare and execute the stored procedure
    $sql = "EXEC mpanae01.[addUser] @fullName=?, @username=?, @pass=?, @sex=?, @birthday=?, @TypeOfUser=?";
    $params = array($fullName, $username, $password, $sex, $birthday, $typeOfUser);
    
    $stmt = sqlsrv_query($conn, $sql, $params);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    // Assuming the stored procedure returns an integer
    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_NUMERIC);
    $result = $row[0];

    if ($result > 0) {
        echo "User successfully created. ID: " . $result;
    } else {
        echo "Error: User creation failed";
    }

    sqlsrv_free_stmt($stmt);
}

sqlsrv_close($conn);
?>