<?php
session_start();

error_reporting(0);
ini_set("display_errors", 0 );

require_once '../Api/conexao.proced.php';
$artId = $_GET['artId'];
$artStatus  = $_POST['artStatus'];

$sql = "UPDATE  tb_artes_pedido SET  artStatus='$artStatus' WHERE artId='$artId'";
$insert = mysqli_query($conexao, $sql);

if($insert == true){
  $_SESSION['statuOK'] = "Status de arte atualizado com sucesso!";
  header('location: ../View/dashboard.php');
}else{
   $_SESSION['statuErro'] = "Falha ao atualizar status!";
  header('location: ../View/dashboard.php');
}
?>
