<?php
session_start();

if(isset($_SESSION['usr_id'])) 
{
	session_destroy();
	unset($_SESSION['usr_id']);
	unset($_SESSION['usr_name']);
	header("Location: home.html");
	exit();
} else {
	header("Location: home.html");
	exit();
}
?>