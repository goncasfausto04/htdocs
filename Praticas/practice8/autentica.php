<?php
session_start();

$link = mysqli_connect('localhost', 'root', '', 'usersdb') or die("Connection failed: " . mysqli_connect_error());

if (isset($_REQUEST['logout']) && $_REQUEST['logout'] == 1) {
    logout();
    exit;
}

if (isset($_POST['user']) && isset($_POST['pass'])) {
    $uuser = $_POST['user'];
    $upass = $_POST['pass'];

    $sql = "SELECT id, password FROM user WHERE user=?";
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, 's', $uuser);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    mysqli_stmt_bind_result($stmt, $userId, $hashedPassword);
    mysqli_stmt_fetch($stmt);

    if (mysqli_stmt_num_rows($stmt) < 1 || !password_verify($upass, $hashedPassword)) {
        mysqli_stmt_close($stmt);
        mysqli_close($link);
        form_login();
        exit;
    } else {
        $_SESSION['user'] = $uuser;
        mysqli_stmt_close($stmt);
        mysqli_close($link);
        header("Location: afterlogin.php");
        exit;
    }
} elseif (!isset($_SESSION['user'])) {
    form_login();
    exit;
}

function form_login() {
    header("Location: index.php");
    exit;
}

function logout() {
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit;
}
?>
