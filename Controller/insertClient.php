<?php
session_start();
include_once '../Api/client.class.Dao.php';

if(!empty($_POST['clientName'])){
    
    $object = new Client();
    $object->setClientName($_POST['clientName']);
    $object->setClientContact($_POST['clientContact']);
    $object->setClientEndereco($_POST['clientEndereco']);

    $dao = new ClientDAO();
    $dao->insertClient($object);

$_SESSION['clientSalvo'] = "Cadastro efetuado com sucesso!";
    header('location: ../View/dashboardPedido.php');

}else{
   $_SESSION ['clientNaoSalvo'] = "Falha no cadastro!  Campos obrigatórios *";
   header('location: ../View/dashboardPedido.php');
}
?>