<?php session_start(); 
	//if(isset($_GET['quit']) && $_GET['quit'] == 'oui') {
		session_destroy();
		header("Location: ../index.php"); 
	//} 
?>
