  
<?php
session_start();
include_once '../Api/client.class.Dao.php';

if(isset($_GET['clientId'])){
 	$object = new Client();
 	$object->setClientId($_GET['clientId']);
    $object->setClientName($_POST['clientName']);
    $object->setClientContact($_POST['clientContact']);
    $object->setClientEndereco($_POST['clientEndereco']);

    $dao = new ClientDAO();
    $dao->updateClient($object);

$_SESSION['clientAtualizado'] = "Registro atualizados sucesso!";
    header('location: ../View/dashboardPedido.php');

}else{
   $_SESSION ['clientNaoAtualizado'] = "Falha na atualização do registro";
   header('location: ../View/dashboardPedido.php');
}
?>