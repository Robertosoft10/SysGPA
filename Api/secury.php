<?php
ob_start();
if(($_SESSION['useName'] == "") || ($_SESSION['password'] == "")) {
	$_SESSION['secury'] = "Login obrigatório";
	header('location: /../sysgpa/index.php');
}

?>