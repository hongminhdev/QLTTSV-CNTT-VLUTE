<?php
	session_start();
	if (isset($_SESSION['email'])){
		unset($_SESSION['email']);
		header('location: user_login.php');
	}
	else{
		header('location: user_login.php');
	}
 ?>
