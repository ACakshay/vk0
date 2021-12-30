<?php 
	session_start();
	
	unset ($_SESSION['login_master_login_id']);
	unset ($_SESSION['login_master_login_recid']);
	unset ($_SESSION['login_master_user_name']);
	unset ($_SESSION['login_master_user_type']);
	
	session_destroy();
	header("location:index.php");
?>
