<?php session_start(); ?>
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
  <link href="Components/img/favicon.png" rel="icon">
  <link href="Components/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Bootstrap core CSS -->
  <link href="Components/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!--external css-->
  <link href="Components/lib/font-awesome/css/font-awesome.css" rel="stylesheet" />
  <!-- Custom styles for this template -->
  <link href="Components/css/style.css" rel="stylesheet">
  <link href="Components/css/style-responsive.css" rel="stylesheet">
  <link href="Components/style.css" rel="stylesheet">
  
  <!-- =======================================================
    Template Name: Dashio
    Template URL: https://templatemag.com/dashio-bootstrap-admin-template/
    Author: TemplateMag.com
    License: https://templatemag.com/license/
  ======================================================= -->
</head>
<?php
 unset($_SESSION['useName'],
 $_SESSION['password']);
?>
<body>
  <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
  <div id="login-page">
    <div class="container">
          <?php if(isset($_SESSION['useCadastrado'])){?>
       <div id="alert-name" class="alert alert-info text-center">
         <?= $_SESSION['useCadastrado'];?>
       </div>
     <?php unset($_SESSION['useCadastrado']); } ?>

      <?php if(isset($_SESSION['vazio'])){?>
       <div id="alert-name" class="alert alert-danger text-center">
         <?= $_SESSION['vazio'];?>
       </div>
     <?php unset($_SESSION['vazio']); } ?>

     <?php if(isset($_SESSION['incorreto'])){?>
       <div id="alert-name" class="alert alert-danger text-center">
         <?= $_SESSION['incorreto'];?>
       </div>
     <?php unset($_SESSION['incorreto']); } ?>

      <?php if(isset($_SESSION['secury'])){?>
       <div id="alert-name" class="alert alert-danger text-center">
         <?= $_SESSION['secury'];?>
       </div>
     <?php unset($_SESSION['secury']); } ?>

      <?php if(isset($_SESSION['emailNull'])){?>
       <div id="alert-name" class="alert alert-danger text-center">
         <?= $_SESSION['emailNull'];?>
       </div>
     <?php unset($_SESSION['emailNull']); } ?>

      <?php if(isset($_SESSION['encontradoErro'])){?>
       <div id="alert-name" class="alert alert-danger text-center">
         <?= $_SESSION['encontradoErro'];?>
       </div>
     <?php unset($_SESSION['encontradoErro']); } ?>

      <?php if(isset($_SESSION['passwordErro'])){?>
       <div id="alert-name" class="alert alert-danger text-center">
         <?= $_SESSION['passwordErro'];?>
       </div>
     <?php unset($_SESSION['passwordErro']); } ?>

      <?php if(isset($_SESSION['passwordOK'])){?>
       <div id="alert-name" class="alert alert-success text-center">
         <?= $_SESSION['passwordOK'];?>
       </div>
     <?php unset($_SESSION['passwordOK']); } ?>

     <?php if(isset($_SESSION['nomeVazio'])){?>
       <div id="alert-name" class="alert alert-danger text-center">
         <?= $_SESSION['nomeVazio'];?>
       </div>
     <?php unset($_SESSION['nomeVazio']); } ?>

      <?php if(isset($_SESSION['nomeErrado'])){?>
       <div id="alert-name" class="alert alert-danger text-center">
         <?= $_SESSION['nomeErrado'];?>
       </div>
     <?php unset($_SESSION['nomeErrado']); } ?>
      <div id="name-system">
        Sys GPA <br>
        <small id="name-system-seg">Sistema Gerenciar Pedido de Artes</small> 
      </div>
      <form class="form-login" action="Api/autentcUser.php" method="post" id="login-form">
        <h2 class="form-login-heading">Login</h2>
        <div class="login-wrap">
          <input type="text" class="form-control" placeholder="Usuário" name="useName">
          <br>
          <input type="password" class="form-control" placeholder="Senha" name="password">
          <br>
          <button class="btn btn-theme btn-block" type="submit"><i class="fa fa-lock"></i> Entrar</button>
          <hr>
          </form>
          <div class="registration">
            <a id="recsenha" data-toggle="modal" data-target="#myModalRecSenha">
            Esqueceu a senha? <br/>
            </a>
          </div>
        </div>

        <!-- Modal -->
                  <div class="modal fade" id="myModalRecSenha" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header" id="model-painel">
                            <h4 class="modal-title" id="myModalLabel">Recuperar senha</h4>
                          </div>
                          <div class="modal-body">
                              <form class="form-horizontal style-form" action="Api/recSenha.php" method="post">
                              <div class="form-group">
                                <label class="col-sm-4 col-sm-4 control-label">E-mail de usuário</label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" name="email">
                                </div>
                              </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal"> Cancelar </button>
                            <button  class="btn btn-success">Próximo</button>
                          </div>
                          </form>
                        </div>
                      </div>
                       </div>
                      </div>
                   <!-- fim Modal -->

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
