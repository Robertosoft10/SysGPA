  
<?php
session_start();
include_once '../Api/use.class.Dao.php';

if(isset($_GET['useId'])){
 	$object = new User();
 	$object->setUseId($_GET['useId']);
    $object->setUseName($_POST['useName']);
    $object->setUseEmail($_POST['useEmail']);
    $object->setUseNivel($_POST['useNivel']);
    $object->setPassword($_POST['password']);

    $dao = new UserDAO();
    $dao->updateUser($object);

$_SESSION['useAtualizado'] = "Registro atualizados sucesso!";
    header('location: ../View/admin.php');

}else{
   $_SESSION ['useNaoAtualizado'] = "Falha na atualização do registro";
   header('location: ../View/admin.php');
}

?>