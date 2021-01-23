<?php
session_start();
require_once '../Api/conexao.proced.php';

$statusId = $_GET['statusId'];
$sql = "DELETE  FROM tb_status WHERE statusId='$statusId'";
$delete = mysqli_query($conexao, $sql);

if($delete == true){
	$_SESSION['statusDelete'] = "Status da arte deletado com sucesso!";
	header('location: ../View/dashboard.php');
}else{
	$_SESSION['statusNaoDelete'] = "Status da arte deletado com sucesso!";
	header('location: ../View/dashboard.php');
}
?>
