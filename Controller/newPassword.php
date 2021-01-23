<?php
session_start();
require_once '../Api/conexao.proced.php';

$useId = $_GET['useId'];
$password  = sha1($_POST['password']);

$sql = "UPDATE tb_usuarios SET password='$password' WHERE useId='$useId'";
$insert = mysqli_query($conexao, $sql);

if($insert == true){
	$_SESSION['passwordOK'] = "Senha redefinida com sucesso! Pode acessar o sistema";
  header('location: /../sysgpa/index.php');
}else{
  $_SESSION['passwordErro'] = "Falha ao redefinir senha!";
  header('location: /../sysgpa/index.php');
}
?>