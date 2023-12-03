<?php
// login_db.php

session_start();

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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role']; 
    $loginSuccess = 0; 

    $tsql = "{call dbo.UserSignIn(?, ?, ?, ?)}"; 
    $params = array(
        array(&$username, SQLSRV_PARAM_IN),
        array(&$password, SQLSRV_PARAM_IN),
        array(&$role, SQLSRV_PARAM_IN), 
        array(&$loginSuccess, SQLSRV_PARAM_OUT)
    );

    $stmt = sqlsrv_query($conn, $tsql, $params);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    sqlsrv_next_result($stmt); 

    if ($loginSuccess == 1) {
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $role; 

        switch ($role) {
            case 'admin':
                header("Location: admin/admin.php");
                break;
            case 'system-admin':
                header("Location: system_admin/system_admin.php");
                break;
            default:
                header("Location: user/user.php"); 
        }
        exit();
    } else {
        echo "<script>alert('Invalid username or password'); window.location.href='login.php';</script>";
    }

    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);
}
?>
