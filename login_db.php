<?php
// login_db.php

session_start();

// Database connection details
$serverName = "mssql.cs.ucy.ac.cy"; // Update with your server name
$connectionOptions = array(
    "Database" => "mpanae01", // Update with your database name
    "Uid" => "mpanae01", // Update with your database username
    "PWD" => "PVTmdk11" // Update with your database password
);

// Connect to database
$conn = sqlsrv_connect($serverName, $connectionOptions);

if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role']; // Retrieve the role from POST data
    $loginSuccess = 0; // Initialize the variable

    // Prepare the stored procedure call
    $tsql = "{call dbo.UserSignIn(?, ?, ?, ?)}"; // Update your stored procedure call
    $params = array(
        array(&$username, SQLSRV_PARAM_IN),
        array(&$password, SQLSRV_PARAM_IN),
        array(&$role, SQLSRV_PARAM_IN), // Add role as an input parameter
        array(&$loginSuccess, SQLSRV_PARAM_OUT)
    );

    // Execute the query
    $stmt = sqlsrv_query($conn, $tsql, $params);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    sqlsrv_next_result($stmt); // Move to the next result to access the output parameter

    // Check login success
    if ($loginSuccess == 1) {
        // Login successful
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $role; // Store role in session

        // Redirect based on role
        switch ($role) {
            case 'admin':
                header("Location: admin/admin.php");
                break;
            case 'system-admin':
                header("Location: system_admin/system_admin.php");
                break;
            default:
                header("Location: user/user.php"); // Default redirect to user.php
        }
        exit();
    } else {
        // Login failed
        echo "<script>alert('Invalid username or password'); window.location.href='login.php';</script>";
    }

    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);
}
?>
