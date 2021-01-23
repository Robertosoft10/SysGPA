  
<?php
session_start();
include_once '../Api/use.class.Dao.php';

if(isset($_GET['useId'])){
$userDAO = new UserDAO();
$userDAO->deleteUser($_REQUEST['useId']);

    $_SESSION['useDeletado'] = "Registro deletado com sucesso";
    header('location: ../View/admin.php');
}else{
    $_SESSION['useNaoDeletado'] = "Falha! Registro não deletado";
    header('location: ../View/admin.php');
}
?>