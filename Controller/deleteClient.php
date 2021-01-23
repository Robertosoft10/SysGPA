  
<?php
session_start();
include_once '../Api/client.class.Dao.php';

if(isset($_GET['clientId'])){
$clientDAO = new ClientDAO();
$clientDAO->deleteClient($_REQUEST['clientId']);

    $_SESSION['clientDeletado'] = "Registro deletado com sucesso";
    header('location: ../View/dashboardPedido.php');
}else{
    $_SESSION['clientNaoDeletado'] = "Falha! Registro não deletado";
    header('location: ../View/dashboardPedido.php');
}
?>