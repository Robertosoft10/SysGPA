<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="Dashboard">
  <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
  <title>Sys - GPA</title>

  <!-- Favicons -->
  <link href="../Components/img/favicon.png" rel="icon">
  <link href="../Components/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Bootstrap core CSS -->
  <link href="../Components/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!--external css-->
  <link href="../Components/lib/font-awesome/css/font-awesome.css" rel="stylesheet" />
  <!-- Custom styles for this template -->
  <link href="../Components/css/style.css" rel="stylesheet">
  <link href="../Components/css/style-responsive.css" rel="stylesheet">
  <link href="../Components/style.css" rel="stylesheet">
  
  <!-- =======================================================
    Template Name: Dashio
    Template URL: https://templatemag.com/dashio-bootstrap-admin-template/
    Author: TemplateMag.com
    License: https://templatemag.com/license/
  ======================================================= -->
</head>
<?php
require_once '../Api/conexao.proced.php';
$use = 0;
$useEmail = $_POST['useEmail'];
$nome = $_POST['nome'];
if (empty($useEmail) || empty($nome)){
$_SESSION['nomeVazio'] = "Informe o nome  de usuário ";
header('location: /../sysgpa/index.php');	
}
if(!empty($_POST['nome'])){
$useEmail = $_POST['useEmail'];
$useName = $_POST['nome'];
$sql = "SELECT * FROM tb_usuarios WHERE useEmail LIKE '%$useEmail%' AND useName LIKE '%$useName%'";
$consult = mysqli_query($conexao, $sql);
$result = mysqli_num_rows($consult);
if($result > 0){
$_SESSION['usuarioOk'] = "Usuário encontrado com sucesso!";
$line = mysqli_fetch_array($consult)?>
<body>
  <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
  <div id="login-page">
    <div class="container">	
    	<?php if(isset($_SESSION['usuarioOk'])){?>
       <div id="alert-name" class="alert alert-success text-center">
         <?= $_SESSION['usuarioOk'];?>
       </div>
     <?php unset($_SESSION['usuarioOk']); } ?>
    <form class="form-login" action="../Controller/newPassword.php?useId=<?= $line['useId'];?>" method="post" id="login-form">
        <h2 class="form-login-heading">Dados</h2>
        <div class="login-wrap">
          <input type="text" class="form-control" value="<?= $line['useEmail']?>">
          <br>
          <input type="text" class="form-control" value="<?= $line['useName']?>">
          <br>
           Defina sua nova senha de usuário *
          <input type="password" class="form-control" name="password" required="">
          <br>
          <button class="btn btn-theme btn-block" type="submit">Salvar</button>
          <hr>
          </form>
        </div>

    </div>
  </div>
  <!-- js placed at the end of the document so the pages load faster -->
  <script src="Components/lib/jquery/jquery.min.js"></script>
  <script src="Components/lib/bootstrap/js/bootstrap.min.js"></script>
  <!--BACKSTRETCH-->
  <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
  <script type="Components/text/javascript" src="Components/lib/jquery.backstretch.min.js"></script>
  <script>
    $.backstretch("img/login-bg.jpg", {
      speed: 500
    });
  </script>
</body>

</html>
<?php
}else{
  $_SESSION['nomeErrado'] = "Nome de usuário não conhecide com o e-mail informado!";
  header('location: /../sysgpa/index.php');
}
}
?>