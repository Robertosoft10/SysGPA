<?php
session_start();
require_once '../Api/conexao.proced.php';

$artId = $_GET['artId'];
$sql = "DELETE  FROM tb_artes_pedido WHERE artId='$artId'";
$delete = mysqli_query($conexao, $sql);

if($delete == true){
	$_SESSION['arteDelete'] = "Pedido de arte deletado com sucesso!";
	header('location: ../View/dashboard.php');
}else{
	$_SESSION['arteNaoDelete'] = "Pedido de arte deletado com sucesso!";
	header('location: ../View/dashboard.php');
}
?>
