<?php
session_start();
require_once 'conexao.proced.php';

$useName = $_POST['useName'];
$password = $_POST['password'];
$descrypt = sha1($password);

if (empty($useName) || empty($password)){
    $_SESSION['vazio'] = "Informe o usuário e a senha";
	header('location: /../sysgpa/index.php');
     exit;
}

$sql_verifica = "SELECT * FROM tb_usuarios WHERE useName='$useName' AND password='$descrypt' LIMIT 1";
$executa = $conexao->query($sql_verifica);
$resultado = $executa->fetch_assoc();

if(empty($resultado)) {
  $_SESSION['incorreto'] = "Usuário  ou senha incorreto!";
  header('location: /../sysgpa/index.php');
}else{
  $_SESSION['useId'] = $resultado['useId'];
  $_SESSION['useName'] = $resultado['useName'];
  $_SESSION['useEmail'] = $resultado['useEmail'];
  $_SESSION['useNivel'] = $resultado['useNivel'];
  $_SESSION['password'] = $resultado['password'];
  $_SESSION['useFoto'] = $resultado['useFoto'];


  header('location: ../View/dashboard.php');
}
?>