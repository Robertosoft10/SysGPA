<?php
session_start();

include_once '../Api/conexao.proced.php';
$useEmail = $_POST['useEmail'];

$sql = "SELECT * FROM tb_usuarios WHERE useEmail='$useEmail'";
$consulta = mysqli_query($conexao, $sql); 
$result = mysqli_fetch_assoc($consulta);
if($result > 1){
    $_SESSION['useExiste'] = "Ops! Usuário com esse email já se encontra cadastrado";
    header('location: ../View/admin.php');

}else{
include_once '../Api/use.class.Dao.php';

    $object = new User();
    $object->setUseName($_POST['useName']);
    $object->setUseEmail($_POST['useEmail']);
    $object->setUseNivel($_POST['useNivel']);
    $object->setPassword(sha1($_POST['password']));
    $object->setUseFoto($_FILES['useFoto']);

     $dao = new UserDAO();
    $dao->insertUser($object);

$_SESSION['useSalvo'] = "Cadastro efetuado com sucesso!";
    header('location: ../View/admin.php');
}
?>