<?php
session_start();
include_once '../Api/conexao.proced.php';
$useEmail = $_POST['useEmail'];

$sql = "SELECT * FROM tb_usuarios WHERE useEmail='$useEmail'";
$consulta = mysqli_query($conexao, $sql); 
$result = mysqli_fetch_assoc($consulta);
if($result > 1){
    $_SESSION['emailExiste'] = "Ops! Usuário com esse email já se encontra cadastrado";
    header('location: ../Config/use.php');

}else{
include_once '../Api/use.class.Dao.php';

    $object = new User();
    $object->setUseName($_POST['useName']);
    $object->setUseEmail($_POST['useEmail']);
    $object->setUseNivel($_POST['useNivel']);
    $object->setPassword(sha($_POST['password']));
    $object->setUsefato($_FILES['usefato']);

     $dao = new UserDAO();
    $dao->insertUser($object);

$_SESSION['useCadastrado'] = "Cadastro efetuado com sucesso! Pode acessar o sistema";
    header('location: /../sysgpa/index.php');
}
?>