<?php
session_start();
error_reporting(0);
ini_set("display_errors", 0 );
require_once '../Api/conexao.proced.php';

$clientId = $_GET['clientId'];
$artTipo  = $_POST['artTipo'];
$artDescripiton  = $_POST['artDescripiton'];
$artEntreg  = $_POST['artEntreg'];
$artValue  = $_POST['artValue'];

$sql = "INSERT INTO tb_artes_pedido(pedClienteId, artTipo, artDescripiton, artEntreg, artValue, artStatus)VALUES('$clientId', '$artTipo', '$artDescripiton', '$artEntreg', '$artValue', '$artStatus')";
$insert = mysqli_query($conexao, $sql);

if($insert == true){
	$_SESSION['arteOK'] = "Pedido de arte efetuado com sucesso!";
}else{
}
require_once '../Api/client.class.Dao.php';
$clientDAO = new ClientDAO();
$clientList = $clientDAO->listClients();
if(isset($_GET['clientId'])){
  $clientId = $_GET['clientId'];
  $client = $clientDAO->searchClient($clientId);
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="Dashboard">
  <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
  <title>Sys GPA</title>
  <!-- Favicons -->
  <link href="Components/img/favicon.png" rel="icon">
  <link href="Components/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Bootstrap core CSS -->
  <link href="../Components/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!--external css-->
  <link href="../Components/lib/font-awesome/css/font-awesome.css" rel="stylesheet" />
  <!-- Custom styles for this template -->
  <link href="../Components/css/style.css" rel="stylesheet">
  <link href="../Components/css/style-responsive.css" rel="stylesheet">
  <link href="../Components/style.css" rel="stylesheet">
  <link href="../Components/lib/advanced-datatable/css/demo_page.css" rel="stylesheet" />
  <link href="../Components/lib/advanced-datatable/css/demo_table.css" rel="stylesheet" />
  <link rel="stylesheet" href="../Components/lib/advanced-datatable/css/DT_bootstrap.css" />
  <!-- Custom styles for this template -->
  <link href="../Components/css/style.css" rel="stylesheet">
  <link href="../Components/css/style-responsive.css" rel="stylesheet">

  <!-- =======================================================
    Template Name: Dashio
    Template URL: https://templatemag.com/dashio-bootstrap-admin-template/
    Author: TemplateMag.com
    License: https://templatemag.com/license/
  ======================================================= -->
</head>

<body>
  <section id="container">
    <!-- **********************************************************************************************************************************************************
        TOP BAR CONTENT & NOTIFICATIONS
        *********************************************************************************************************************************************************** -->
    <!--header start-->
    <header class="header black-bg">
      <div class="sidebar-toggle-box">
        <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
      </div>
      <!--logo start-->
      <a href="index.html" class="logo"><b>Sys<span>GPA</span></b></a>
      <!--logo end-->
      <div class="nav notify-row" id="top_menu">
        <!--  notification start -->
        <ul class="nav top-menu">
          <!-- settings start -->
          <li class="dropdown">
          </li>
        </ul>
        <!--  notification end -->
      </div>
      <div class="top-menu">
        <ul class="nav pull-right top-menu">
          <li><a class="logout" href="../Backup_db/dbBackup.php">Sair</a></li>
        </ul>
      </div>
    </header>
    <!--header end-->
    <!-- **********************************************************************************************************************************************************
        MAIN SIDEBAR MENU
        *********************************************************************************************************************************************************** -->
    <!--sidebar start-->
    <aside>
      <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">
          <p class="centered"><a href="">
          <img id="img-use" src="<?= "../Components/img/".$_SESSION['useFoto'];?>" class="img-circle" width="80"></a></p>
          <h5 class="centered">
             <small ><a id="altfot" href="pageAltFoto.php?useId=<?= $_SESSION['useId'];?>"> Alterar foto</a></small><br><br>
            <?= $_SESSION['useName'];?></h5>
          <li class="mt" id="link-pag">
            <a href="dashboard.php"  id="link-pag">
              <i class="fa fa-dashboard"></i>
              <span>Dashboard</span>
              </a>
          </li>
           <li class="mt" id="link-pag">
            <a href="dashboardPedido.php"  id="link-pag">
              <i class="fa fa-pencil-square"></i>
              <span>Pedidos Artes</span>
              </a>
          </li>
          <li class="mt"  id="link-pag">
            <a href="admin.php"  id="link-pag">
              <i class="fa fa-cogs"></i>
              <span>Admin</span>
              </a>
          </li>
           <li class="mt"  id="link-pag">
            <a href="../Backup_db/dbBackup.php"  id="link-pag">
              <i class="fa fa-database"></i>
              <span>Backup</span>
              </a>
          </li>
        </ul>
        <!-- sidebar menu end-->
      </div>
    </aside>
    <!--sidebar end-->
    <!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i> Pedido de Arte</h3>
        <div class="row mb">
         <div class="col-lg-12">
          <?php if(isset($_SESSION['arteOK'])){?>
          <div class="alert alert-success"><?= $_SESSION['arteOK'];?>
            <a href="../View/dashboardView.php?clientId=<?= $client->getClientId();?>">
              <button class="btn btn-success">Ok</button>
            </a>
          </div>
          <?php unset($_SESSION['arteOK']); }?>
            <div class="form-panel">
              <h4 class="mb"><i class="fa fa-angle-right"></i> Cliente
              </h4>
              Nome: <?= $client->getClientName();?><br>
              Contato: <?= $client->getClientContact();?><br>
              Endereço: <?= $client->getClientEndereco();?><br><hr>
              <h4 class="mb"><i class="fa fa-angle-right"></i> Pedido 
                <div class="pull-right">
                <button class="btn btn-success" data-toggle="modal" data-target="#myModalPedir">Pedir Arte</button>
                </div>
              </h4>
              <!-- Modal -->
                  <div class="modal fade" id="myModalPedir" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header" id="model-painel">
                            <h4 class="modal-title" id="myModalLabel">Pedido de Arte</h4>
                          </div>
                          <div class="modal-body">
                              <form class="form-horizontal style-form" action="../Controller/insertArte.php?clientId=<?= $client->getClientId();?>" method="post">
                              <div class="form-group">
                                <label class="col-sm-4 col-sm-4 control-label">Tipo da Arte: *</label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" name="artTipo" required="">
                                </div>
                              </div>
                                <div class="form-group">
                                <label class="col-sm-4 col-sm-4 control-label">Descrição: </label>
                                <div class="col-sm-8">
                                  <textarea id="textarea-description"  type="text" class="form-control" name="artDescripiton"></textarea>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="col-sm-4 col-sm-4 control-label">Prazo / Entrega: *</label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" name="artEntreg"  required="">
                                </div>
                              </div>

                              <div class="form-group">
                                <label class="col-sm-4 col-sm-4 control-label">Valor * </label>
                                <div class="col-sm-8">
                                  <input type="number" class="form-control" name="artValue"  required="">
                                </div>
                              </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal"> Cancelar Pedido</button>
                            <button  class="btn btn-success">Salvar Pedido</button>
                          </div>
                          </form>
                        </div>
                      </div>
                       </div>
                      </div>
                   <!-- fim Modal -->

                  
              </div>
            </div>
          </div>
          <!-- page start-->
          <div class="content-panel">
            <div class="">
              <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered" id="hidden-table-info">
                <thead>
                  <tr>
                    <th>
                    </th>
                    <th>Arte</th>
                    <th>Descrição</th>
                    <th>Prazo Entrega</th>
                    <th>Valor</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $sql = "SELECT * FROM  tb_artes_pedido AP JOIN tb_clientes CL ON AP.pedClienteId = CL.clientId WHERE clientId='$clientId'";
                  $busca = mysqli_query($conexao, $sql);
                  while($arte = mysqli_fetch_array($busca)){
                  ?>
                  <tr  id="table-td">
                    <td  class="col-lg-2">
                      <button class="btn btn-danger btm-sm">
                    <i class="fa fa-trash" id="icon-del-view" data-toggle="modal" data-target="#myModalDeleteArte<?= $arte['artId'];?>"></i>
                    </button>
                 <!-- Modal -->
                    <div class="modal fade" id="myModalDeleteArte<?= $arte['artId'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header" id="model-painel">
                            <h4 class="modal-title" id="myModalLabel">Deletar Arte</h4>
                          </div>
                          <div class="modal-body">
                           Deseja mesmo deletar este registro?
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Não Cancelar</button>
                            <a href="../Controller/deleteArte.php?artId=<?= $arte['artId'];?>">
                            <button type="button" class="btn btn-success">Sim deletar</button>
                            </a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                   <!-- fim Modal -->
                    <button class="btn btn-primary btm-sm">
                    <i class="fa fa-pencil" data-toggle="modal" data-target="#myModalEdit<?= $arte['artId'];?>" id="icon-edit-view"></i>
                  </button>
                     <!-- Modal -->
                    <div class="modal fade" id="myModalEdit<?= $arte['artId'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header" id="model-painel">
                            <h4 class="modal-title" id="myModalLabel">Alterar pedido de  Arte</h4>
                          </div>
                          <div class="modal-body">
                         <form action="../Controller/editArte.php?clientId=<?= $arte['pedClienteId'];?>" method="post">
                          ID<br> <input id="input-edit-art" class="form-control"  type="text" name="artId" value="<?= $arte['artId'];?>"><br><br>
                          Tipo da Arte<br> 
                          <input id="input-edit-art" class="form-control"  type="text" name="artTipo" value="<?= $arte['artTipo'];?>"><br><br>
                           Descrição<br> 
                           <textarea id="input-edit-art-texteare" class="form-control"  type="text" name="artDescripiton"><?= $arte['artDescripiton'];?></textarea><br><br>
                            Prazo / Entrega:<br> 
                            <input id="input-edit-art" class="form-control"  type="text" name="artEntreg" value="<?= $arte['artEntreg'];?>"><br><br>
                             Valor<br>
                             <input id="input-edit-art" class="form-control"  type="text" name="artValue" value="<?= $arte['artValue'];?>"><br><br>
                          </div>
                          <div class="modal-footer">
                            <button  class="btn btn-success">Salvar Alterações</button>
                              </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                   <!-- fim Modal -->
                    </td>
                    <td id="table-td" class="col-lg-2"><?= $arte['artTipo'];?></td>
                    <td  class="col-lg-4"><?= $arte['artDescripiton'];?></td>
                    <td   class="col-lg-2"><?= $arte['artEntreg'];?></td>
                    <td  class="col-lg-2">R$ <?= number_format($arte['artValue'], 2, ',', '.');?></td>
                    <?php if($arte['artStatus'] == 1){?>
                    <td>
                      <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#myModalStatusOpc<?= $arte['artId'];?>">Não iniciou</button>
                      <!-- Modal status-->
                     <div class="modal fade" id="myModalStatusOpc<?= $arte['artId'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header" id="model-painel">
                            <h4 class="modal-title" id="myModalLabel">Opções de Status</h4>
                          </div>
                          <div class="modal-body">
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal"> Cancelar </button>
                            <button  class="btn btn-primary" data-toggle="modal" data-target="#myModalAltStatus<?= $arte['artId'];?>">Alterar Status</button>
                            <button  class="btn btn-danger" data-toggle="modal" data-target="#myModalDelStatus<?= $arte['artId'];?>">Deletar Status</button>
                          </div>
                        </div>
                      </div>
                       </div>
                      </div>
                   <!-- fim Modal -->
                   <!-- Modal -->
                  <div class="modal fade" id="myModalAltStatus<?= $arte['artId'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header" id="model-painel">
                            <h4 class="modal-title" id="myModalLabel">Alterar Status</h4>
                          </div>
                          <div class="modal-body">
                              <form class="form-horizontal style-form" action="../Controller/insertStatus.php?artId=<?= $arte['artId'];?>" method="post">
                              <div class="form-group">
                                <label class="col-sm-4 col-sm-4 control-label">Status: </label>
                                <div class="col-sm-8">
                                  <select type="text" class="form-control" name="artStatus">
                                   <?php if($arte['artStatus']== 1){?>
                                    <option value="1">Não iniciou</option>
                                  <?php }elseif($arte['artStatus'] == 2){?>
                                    <option value="2">Em execução</option>
                                  <?php }elseif($arte['artStatus'] == 3){?>
                                    <option value="3">Entregue</option>
                                  <?php }elseif($arte['artStatus'] == 4){?>
                                  <option value="4">Não entregue</option>
                                  <?php }?>
                                    <option value="1">Não iniciou</option>
                                    <option value="2">Em execução</option>
                                    <option value="3">Entregue</option>
                                    <option value="4">Não entregue</option>
                                  </select>
                                </div>
                              </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal"> Cancelar </button>
                            <button  class="btn btn-success">Salvar</button>
                          </div>
                          </form>
                        </div>
                      </div>
                       </div>
                      </div>
                   <!-- fim Modal -->

                     <!-- Modal -->
                    <div class="modal fade" id="myModalDelStatus<?= $arte['artId'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header" id="model-painel">
                            <h4 class="modal-title" id="myModalLabel">Deletar Status</h4>
                          </div>
                          <div class="modal-body">
                           Deseja mesmo deletar este registro?
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Não Cancelar</button>
                            <form action="../Controller/insertStatus.php?artId=<?= $arte['artId'];?>" method="post">
                            <button  class="btn btn-success">Sim deletar</button>
                          </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                   <!-- fim Modal -->


                    </td>
                    <?php }elseif($arte['artStatus'] == 2){?>
                    <td>
                      <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModalStatusOpc<?= $arte['artId'];?>">Em execução</button>
                       <!-- Modal status-->
                     <div class="modal fade" id="myModalStatusOpc<?= $arte['artId'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header" id="model-painel">
                            <h4 class="modal-title" id="myModalLabel">Opções de Status</h4>
                          </div>
                          <div class="modal-body">
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal"> Cancelar </button>
                            <button  class="btn btn-primary" data-toggle="modal" data-target="#myModalAltStatus<?= $arte['artId'];?>">Alterar Status</button>
                            <button  class="btn btn-danger" data-toggle="modal" data-target="#myModalDelStatus<?= $arte['artId'];?>">Deletar Status</button>
                          </div>
                        </div>
                      </div>
                       </div>
                      </div>
                   <!-- fim Modal -->
                   <!-- Modal -->
                  <div class="modal fade" id="myModalAltStatus<?= $arte['artId'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header" id="model-painel">
                            <h4 class="modal-title" id="myModalLabel">Alterar Status</h4>
                          </div>
                          <div class="modal-body">
                              <form class="form-horizontal style-form" action="../Controller/insertStatus.php?artId=<?= $arte['artId'];?>" method="post">
                              <div class="form-group">
                                <label class="col-sm-4 col-sm-4 control-label">Status: </label>
                                <div class="col-sm-8">
                                  <select type="text" class="form-control" name="artStatus">
                                  <?php if($arte['artStatus']== 1){?>
                                    <option value="1">Não iniciou</option>
                                  <?php }elseif($arte['artStatus'] == 2){?>
                                    <option value="2">Em execução</option>
                                  <?php }elseif($arte['artStatus'] == 3){?>
                                    <option value="3">Entregue</option>
                                  <?php }elseif($arte['artStatus'] == 4){?>
                                  <option value="4">Não entregue</option>
                                  <?php }?>
                                    <option value="1">Não iniciou</option>
                                    <option value="2">Em execução</option>
                                    <option value="3">Entregue</option>
                                    <option value="4">Não entregue</option>
                                  </select>
                                </div>
                              </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal"> Cancelar </button>
                            <button  class="btn btn-success">Salvar</button>
                          </div>
                          </form>
                        </div>
                      </div>
                       </div>
                      </div>
                   <!-- fim Modal -->

                     <!-- Modal -->
                    <div class="modal fade" id="myModalDelStatus<?= $arte['artId'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header" id="model-painel">
                            <h4 class="modal-title" id="myModalLabel">Deletar Status</h4>
                          </div>
                          <div class="modal-body">
                           Deseja mesmo deletar este registro?
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Não Cancelar</button>
                            <form action="../Controller/insertStatus.php?artId=<?= $arte['artId'];?>" method="post">
                            <button  class="btn btn-success">Sim deletar</button>
                          </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                   <!-- fim Modal -->
                    </td>
                     <?php }elseif($arte['artStatus'] == 3){?>
                    <td>
                      <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModalStatusOpc<?= $arte['artId'];?>">Entregue</button>
                       <!-- Modal status-->
                     <div class="modal fade" id="myModalStatusOpc<?= $arte['artId'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header" id="model-painel">
                            <h4 class="modal-title" id="myModalLabel">Opções de Status</h4>
                          </div>
                          <div class="modal-body">
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal"> Cancelar </button>
                            <button  class="btn btn-primary" data-toggle="modal" data-target="#myModalAltStatus<?= $arte['artId'];?>">Alterar Status</button>
                            <button  class="btn btn-danger" data-toggle="modal" data-target="#myModalDelStatus<?= $arte['artId'];?>">Deletar Status</button>
                          </div>
                        </div>
                      </div>
                       </div>
                      </div>
                   <!-- fim Modal -->
                   <!-- Modal -->
                  <div class="modal fade" id="myModalAltStatus<?= $arte['artId'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header" id="model-painel">
                            <h4 class="modal-title" id="myModalLabel">Alterar Status</h4>
                          </div>
                          <div class="modal-body">
                              <form class="form-horizontal style-form" action="../Controller/insertStatus.php?artId=<?= $arte['artId'];?>" method="post">
                              <div class="form-group">
                                <label class="col-sm-4 col-sm-4 control-label">Status: </label>
                                <div class="col-sm-8">
                                  <select type="text" class="form-control" name="artStatus">
                                   <?php if($arte['artStatus']== 1){?>
                                    <option value="1">Não iniciou</option>
                                  <?php }elseif($arte['artStatus'] == 2){?>
                                    <option value="2">Em execução</option>
                                  <?php }elseif($arte['artStatus'] == 3){?>
                                    <option value="3">Entregue</option>
                                  <?php }elseif($arte['artStatus'] == 4){?>
                                  <option value="4">Não entregue</option>
                                  <?php }?>
                                    <option value="1">Não iniciou</option>
                                    <option value="2">Em execução</option>
                                    <option value="3">Entregue</option>
                                    <option value="4">Não entregue</option>
                                  </select>
                                </div>
                              </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal"> Cancelar </button>
                            <button  class="btn btn-success">Salvar</button>
                          </div>
                          </form>
                        </div>
                      </div>
                       </div>
                      </div>
                   <!-- fim Modal -->
                     <!-- Modal -->
                    <div class="modal fade" id="myModalDelStatus<?= $arte['artId'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header" id="model-painel">
                            <h4 class="modal-title" id="myModalLabel">Deletar Status</h4>
                          </div>
                          <div class="modal-body">
                           Deseja mesmo deletar este registro?
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Não Cancelar</button>
                            <form action="../Controller/insertStatus.php?artId=<?= $arte['artId'];?>" method="post">
                            <button  class="btn btn-success">Sim deletar</button>
                          </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                   <!-- fim Modal -->
                    </td>
                  <?php }elseif($arte['artStatus'] == 4){?>
                    <td>
                      <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModalStatusOpc<?= $arte['artId'];?>">Não Entregue</button>
                       <!-- Modal status-->
                     <div class="modal fade" id="myModalStatusOpc<?= $arte['artId'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header" id="model-painel">
                            <h4 class="modal-title" id="myModalLabel">Opções de Status</h4>
                          </div>
                          <div class="modal-body">
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal"> Cancelar </button>
                            <button  class="btn btn-primary" data-toggle="modal" data-target="#myModalAltStatus<?= $arte['artId'];?>">Alterar Status</button>
                            <button  class="btn btn-danger" data-toggle="modal" data-target="#myModalDelStatus<?= $arte['artId'];?>">Deletar Status</button>
                          </div>
                        </div>
                      </div>
                       </div>
                      </div>
                   <!-- fim Modal -->
                   <!-- Modal -->
                  <div class="modal fade" id="myModalAltStatus<?= $arte['artId'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header" id="model-painel">
                            <h4 class="modal-title" id="myModalLabel">Alterar Status</h4>
                          </div>
                          <div class="modal-body">
                              <form class="form-horizontal style-form" action="../Controller/insertStatus.php?artId=<?= $arte['artId'];?>" method="post">
                              <div class="form-group">
                                <label class="col-sm-4 col-sm-4 control-label">Status: </label>
                                <div class="col-sm-8">
                                  <select type="text" class="form-control" name="artStatus">
                                  <?php if($arte['artStatus']== 1){?>
                                    <option value="1">Não iniciou</option>
                                  <?php }elseif($arte['artStatus'] == 2){?>
                                    <option value="2">Em execução</option>
                                  <?php }elseif($arte['artStatus'] == 3){?>
                                    <option value="3">Entregue</option>
                                  <?php }elseif($arte['artStatus'] == 4){?>
                                  <option value="4">Não entregue</option>
                                  <?php }?>
                                    <option value="1">Não iniciou</option>
                                    <option value="2">Em execução</option>
                                    <option value="3">Entregue</option>
                                    <option value="4">Não entregue</option>
                                  </select>
                                </div>
                              </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal"> Cancelar </button>
                            <button  class="btn btn-success">Salvar</button>
                          </div>
                          </form>
                        </div>
                      </div>
                       </div>
                      </div>
                   <!-- fim Modal -->

                     <!-- Modal -->
                    <div class="modal fade" id="myModalDelStatus<?= $arte['artId'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header" id="model-painel">
                            <h4 class="modal-title" id="myModalLabel">Deletar Status</h4>
                          </div>
                          <div class="modal-body">
                           Deseja mesmo deletar este registro?
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Não Cancelar</button>
                            <form action="../Controller/insertStatus.php?artId=<?= $arte['artId'];?>" method="post">
                            <button  class="btn btn-success">Sim deletar</button>
                          </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                   <!-- fim Modal -->
                    </td>
                    <?php }else{?>
                      <td>
                      <button class="btn btn-default btn-sm" data-toggle="modal" data-target="#myModalInsertStatus<?= $arte['artId'];?>">Status</button>
                      <!-- Modal -->
                  <div class="modal fade" id="myModalInsertStatus<?= $arte['artId'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header" id="model-painel">
                            <h4 class="modal-title" id="myModalLabel">Status da Arte</h4>
                          </div>
                          <div class="modal-body">
                              <form class="form-horizontal style-form" action="../Controller/insertStatus.php?artId=<?= $arte['artId'];?>" method="post">
                              <div class="form-group">
                                <label class="col-sm-4 col-sm-4 control-label">Status: *</label>
                                <div class="col-sm-8">
                                  <select type="text" class="form-control" name="artStatus" required="">
                                    <option></option>
                                    <option value="1">Não iniciou</option>
                                    <option value="2">Em execução</option>
                                    <option value="3">Entregue</option>
                                    <option value="4">Não entregue</option>
                                  </select>
                                </div>
                              </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal"> Cancelar </button>
                            <button  class="btn btn-success">Salvar</button>
                          </div>
                          </form>
                        </div>
                      </div>
                       </div>
                      </div>
                   <!-- fim Modal -->
                    <?php }?>
                    
                    </td>
                  </tr>
                <?php } ?>
                </tbody>
              </table>


            </div>
          </div>
          <!-- page end-->
        </div>
        
                  
      </section>
      <!-- /wrapper -->
    </section>
    <!-- /MAIN CONTENT -->
    <!--main content end-->
    <!--footer start-->
    <footer class="site-footer">
      <div class="text-center">
        <p>
          &copy; Copyrights <strong>Sys GPA</strong>. Todos os direitos reservados: Robertosoft10
        </p>
      
    </footer>
    <!--footer end-->
  </section>
   <script src="../Components/lib/jquery/jquery.min.js"></script>
  <script src="../Components/lib/bootstrap/js/bootstrap.min.js"></script>
  <script class="include" type="text/javascript" src="../Components/lib/jquery.dcjqaccordion.2.7.js"></script>
  <script src="../Components/lib/jquery.scrollTo.min.js"></script>
  <script src="../Components/lib/jquery.nicescroll.js" type="text/javascript"></script>
  <!--common script for all pages-->
  <script src="../Components/lib/common-scripts.js"></script>
  <!--script for this page-->
  <script type="text/javascript" src="../Components/lib/gritter/js/jquery.gritter.js"></script>
  <script type="text/javascript" src="../Components/lib/gritter-conf.js"></script>
  <!-- js placed at the end of the document so the pages load faster -->
  <script src="../Components/lib/jquery/jquery.min.js"></script>
  <script type="text/javascript" language="javascript" src="../Components/lib/advanced-datatable/js/jquery.js"></script>
  <script src="../Components/lib/bootstrap/js/bootstrap.min.js"></script>
  <script class="include" type="text/javascript" src="../Components/lib/jquery.dcjqaccordion.2.7.js"></script>
  <script src="../Components/lib/jquery.scrollTo.min.js"></script>
  <script src="../Components/lib/jquery.nicescroll.js" type="text/javascript"></script>
  <script type="text/javascript" language="javascript" src="../Components/lib/advanced-datatable/js/jquery.dataTables.js"></script>
  <script type="text/javascript" src="../Components/lib/advanced-datatable/js/DT_bootstrap.js"></script>
  <!--common script for all pages-->
  <script src="../Components/lib/common-scripts.js"></script>
  <!--script for this page-->
  <script type="text/javascript">
    /* Formating function for row details */

    $(document).ready(function() {
      /*
       * Insert a 'details' column to the table
      /*
       * Initialse DataTables, with no sorting on the 'details' column
       */
      var oTable = $('#hidden-table-info').dataTable({
        "aoColumnDefs": [{
          "bSortable": false,
          "aTargets": [0]
        }],
        "aaSorting": [
          [1, 'asc']
        ]
      });

      /* Add event listener for opening and closing details
       * Note that the indicator for showing which row is open is not controlled by DataTables,
       * rather it is done here
       */
      $('#hidden-table-info tbody td img').live('click', function() {
        var nTr = $(this).parents('tr')[0];
        if (oTable.fnIsOpen(nTr)) {
          /* This row is already open - close it */
          this.src = "lib/advanced-datatable/media/images/details_open.png";
          oTable.fnClose(nTr);
        } else {
          /* Open this row */
          this.src = "lib/advanced-datatable/images/details_close.png";
          oTable.fnOpen(nTr, fnFormatDetails(oTable, nTr), 'details');
        }
      });
    });
  </script>
</body>

</html>
