  
<?php
session_start();
include_once '../Api/conexao.proced.php';

$useId = $_GET['useId'];
$useFoto = $_FILES['useFoto'];
$sql = "SELECT * FROM tb_usuarios WHERE useId='$useId'";
$consult = mysqli_query($conexao, $sql);
while($result = mysqli_fetch_array($consult)){
	$arquivo_db = $result['useId'];
}
unlink("../Components/img/$arquivo_db");

if(isset($_FILES['useFoto'])){
	$extensao = strtolower(substr($_FILES['useFoto']['name'], - 4));
	$novo_nome = sha1(time()) . $extensao;
    $diretorio = "../Components/img/";
	move_uploaded_file($_FILES['useFoto']['tmp_name'], $diretorio.$novo_nome);
	$sql = "UPDATE tb_usuarios SET useFoto='$novo_nome' WHERE useId='$useId'";
	$update = mysqli_query($conexao, $sql);

if($update == true){
    $_SESSION['fotoAtualiza'] = "Foto atualizada com sucesso!";
    header('location: ../View/dashboard.php');
}else{
     $_SESSION['fotoErroAtualiza'] = "Falha na atuzalização da foto!";
    header('location: ../View/dashboard.php');
}
}
?>