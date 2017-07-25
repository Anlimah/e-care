<?php
ob_start();
session_start();
if (!isset($_SESSION['userid']) || (trim($_SESSION['userid']) == '')) 
{
    header('location:../index.php');
    exit();
	}
?>