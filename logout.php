<?php
session_start();
include('../conn/conn.php');

$user =  $_SESSION['now'];

$logout = $conn->prepare("UPDATE user_log SET logout_time = NOW() WHERE login_time = '$user'");
$logout->execute();

$upds = $conn->prepare("UPDATE useraccount SET user_status = ? WHERE user_ID = ?");
$upds->execute(array('OFFLINE', $_SESSION['userid']));

session_destroy();
header('location:../index.php');
?>