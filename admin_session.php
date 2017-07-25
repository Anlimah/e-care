<?php
ob_start();
session_start();
if (!isset($_SESSION['adminid']) || (trim($_SESSION['adminid']) == '')) 
{
    header('location:../index.php');
    exit();
	}
?>