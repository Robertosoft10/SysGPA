<?php
session_start();
include_once '../Api/secury.php';
require_once '../Api/use.class.Dao.php';
$userDAO = new UserDAO();
$useList = $userDAO->listUsers();

if(isset($_GET['useId'])){
  $useId = $_GET['useId'];
  $use = $userDAO->searchUser($useId);
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
      <a href="" class="logo"><b>Sys<span>GPA</span></b></a>
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
        <h3><i class="fa fa-angle-right"></i> Admin</h3>
        <div class="row mb">
         <div class="col-lg-12">
          <?php if(isset($_SESSION['useExiste'])){?>
            <div id="alert-name" class="alert alert-danger">
               <?= $_SESSION['useExiste'];?>
            </div>
           <?php unset($_SESSION['useExiste']); } ?>

           <?php if(isset($_SESSION['useSalvo'])){?>
            <div id="alert-name" class="alert alert-success">
               <?= $_SESSION['useSalvo'];?>
            </div>
           <?php unset($_SESSION['useSalvo']); } ?>


            <?php if(isset($_SESSION['useNaoAtualizado'])){?>
            <div id="alert-name" class="alert alert-danger">
               <?= $_SESSION['useNaoAtualizado'];?>
            </div>
           <?php unset($_SESSION['useNaoAtualizado']); } ?>

           <?php if(isset($_SESSION['useAtualizado'])){?>
            <div id="alert-name" class="alert alert-success">
               <?= $_SESSION['useAtualizado'];?>
            </div>
           <?php unset($_SESSION['useAtualizado']); } ?>

           
            <?php if(isset($_SESSION['useNaoDeletado'])){?>
            <div id="alert-name" class="alert alert-danger">
               <?= $_SESSION['useNaoDeletado'];?>
            </div>
           <?php unset($_SESSION['useNaoDeletado']); } ?>

           <?php if(isset($_SESSION['useDeletado'])){?>
            <div id="alert-name" class="alert alert-success">
               <?= $_SESSION['useDeletado'];?>
            </div>
           <?php unset($_SESSION['useDeletado']); } ?>
            <div class="form-panel">
              <?php if($_SESSION['useNivel'] == 1){?>
              <?php if(!isset($_GET['useId'])){?>
              <h4 class="mb"><i class="fa fa-angle-right"></i> Inserir Usuário</h4>
              <form class="form-horizontal style-form" action="../Controller/insertUse.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Nome de Usuário: *</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="useName" required="">
                  </div>
                </div>
                  <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">E-mail: *</label>
                  <div class="col-sm-10">
                    <input type="email" class="form-control" name="useEmail"  required="">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Nível: *</label>
                  <div class="col-sm-10">
                    <select type="text" class="form-control" name="useNivel"  required="">
                      <option></option>
                       <option value="1">Admin</option>
                      <option value="2">Usuário</option>
                      </select> 
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Senha de Usuário *</label>
                  <div class="col-sm-10">
                    <input type="password" class="form-control" name="password"  required="">
                  </div>
                </div>
                 <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Foto</label>
                  <div class="col-sm-10">
                    <input type="file" class="form-control" name="useFoto">
                  </div>
                </div>
                <button class="btn btn-success"><i class="fa fa-save"></i> Inserir Usuário</button>
                </div>
                </div>
                </div>
              </form>
            <?php }else{?>
              <h4 class="mb"><i class="fa fa-angle-right"></i> Altarar Usuário</h4>
              <form class="form-horizontal style-form" action="../Controller/editUse.php?useId=<?= $use->getUseId();?>" method="post">
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Nome de Usuário: </label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="useName"
                  value="<?= $use->getUseName();?>">
                  </div>
                </div>
                  <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">E-mail: </label>
                  <div class="col-sm-10">
                    <input type="email" class="form-control" name="useEmail"
                     value="<?= $use->getUseEmail();?>">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Nível: </label>
                  <div class="col-sm-10">
                    <select type="text" class="form-control" name="useNivel">
                      <?php if($use->getUseNivel() == 1){?>
                      <option value="1">Administrador</option>
                    <?php }else {?>
                      <option value="2">Usuário</option>
                    <?php }?>
                     <option value="1">Admin</option>
                     <option value="2">Usuário</option>
                      </select> 
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Digite sua senha<br> ou nova senha * </label>
                  <div class="col-sm-10">
                    <input type="password" class="form-control" name="password" required="">
                  </div>
                </div>
                <button class="btn btn-success"><i class="fa fa-save"></i> Salvar alterações</button>
                </div>
                </div>
                </div>
              </form>
            <?php }?>
          <!-- page start-->
          <div class="content-panel" id="table-page">
            <div class="">
              <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered" id="hidden-table-info">
                <thead>
                  <tr>
                    <th></th>
                    <th>Usuário</th>
                    <th>E-mail</th>
                    <th>Nível</th>
                  </tr>
                </thead>
                <tbody>
                  <?php while($object = array_shift($useList)){?>
                  <tr  id="table-td">
                    <td>
                    <button class="btn btn-danger btn-sm">
                      <i class="fa fa-trash"  data-toggle="modal" data-target="#myModalDelete<?= $object->getUseId();?>" id="icon-del-view"></i>
                      </button>
                    <!-- Modal -->
                    <div class="modal fade" id="myModalDelete<?= $object->getUseId();?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header" id="model-painel">
                            <h4 class="modal-title" id="myModalLabel">Deletar Cliente</h4>
                          </div>
                          <div class="modal-body">
                           Deseja mesmo deletar este registro?
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Não Cancelar</button>
                            <a href="../Controller/deleteUse.php?useId=<?= $object->getUseId();?>">
                            <button type="button" class="btn btn-danger">Sim deletar</button>
                            </a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                   <!-- fim Modal -->
                
                  <a href="admin.php?useId=<?= $object->getUseId();?>">
                      <button class="btn btn-primary btn-sm">
                  <i class="fa fa-pencil" ></i>
                </button>
                </a>
                    </a>
                    </td>
                    <td id="table-td"><?= $object->getUseName();?></td>
                    <td><?= $object->getUseEmail();?></td>
                    <?php if($object->getUseNivel() == 1){?>
                    <td>Adminstrador</td>
                    <?php }else{?>
                      <td>Usuário</td>
                    <?php }?>
                  </tr>
                <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        <?php }else{?>
          <!-- page end-->

            <div id="alert-name" class="alert alert-danger">
               <h4>Você não pode acessar o conteúde desta página por que usuário logado não é adminstrador,
               acesse com o adminstrador para ter acesso!</h4>
            </div>
        <?php } ?>
        </div>
        <!-- /row -->
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
