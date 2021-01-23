<?php
session_start();
error_reporting(0);
ini_set("display_errors", 0 );
require_once '../Api/secury.php';
require_once '../Api/client.class.Dao.php';
$clientDAO = new ClientDAO();
$clientList = $clientDAO->listClients();
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
  <link href="../Components/img/favicon.png" rel="icon">
  <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

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
              <span>Admin Usuários</span>
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
        <h3><i class="fa fa-angle-right"></i> Dashboard</h3>
        <div class="row mb">
         <div class="col-lg-12">
          <?php if(isset($_SESSION['fotoErroAtualiza'])){?>
          <div class="alert alert-danger"><?= $_SESSION['fotoErroAtualiza'];?></div>
          <?php unset($_SESSION['fotoErroAtualiza']); }?>

           <?php if(isset($_SESSION['fotoAtualiza'])){?>
          <div class="alert alert-success"><?= $_SESSION['fotoAtualiza'];?></div>
          <?php unset($_SESSION['fotoAtualiza']); }?>

          <?php if(isset($_SESSION['arteNaoDelete'])){?>
          <div class="alert alert-danger"><?= $_SESSION['arteNaoDelete'];?></div>
          <?php unset($_SESSION['arteNaoDelete']); }?>

          <?php if(isset($_SESSION['arteDelete'])){?>
          <div class="alert alert-success"><?= $_SESSION['arteDelete'];?></div>
          <?php unset($_SESSION['arteDelete']); }?>

          <?php if(isset($_SESSION['statusNaoDelete'])){?>
          <div class="alert alert-danger"><?= $_SESSION['statusNaoDelete'];?></div>
          <?php unset($_SESSION['statusNaoDelete']); }?>

          <?php if(isset($_SESSION['statusDelete'])){?>
          <div class="alert alert-success"><?= $_SESSION['statusDelete'];?></div>
          <?php unset($_SESSION['statusDelete']); }?>

           <?php if(isset($_SESSION['statuErro'])){?>
          <div class="alert alert-danger"><?= $_SESSION['statuErro'];?></div>
          <?php unset($_SESSION['statuErro']); }?>

            <?php if(isset($_SESSION['statuOK'])){?>
          <div class="alert alert-success"><?= $_SESSION['statuOK'];?></div>
          <?php unset($_SESSION['statuOK']); }?>
            <div class="form-panel">

              <?php
              require_once '../Api/conexao.proced.php';
              $sql = "SELECT status FROM tb_status";
              $consult = mysqli_query($conexao, $sql);
              $cont = mysqli_num_rows($consult);
              if($cont == 0){?>
                <div class="alert alert-success">  Não há arte pendente!
                </span></div>
              <?php }else{?>
                  <div class="alert alert-danger"><i class="fa fa-warning"></i> Atenção tem arte(s) para serem entregue(s)</div>
              <?php } ?>
                </div>
                </div>
                </div>
                <!-- page start-->
                 <div class="content-panel" id="table-page">
                  <div class="">
                    <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered" id="hidden-table-info">
                      <thead>
                    <tr>
                      <th></th>
                      <th>Cliente</th>
                      <th>Contato</th>
                    </tr>
                  </thead>
                  <tbody>
                   <?php while($object = array_shift($clientList)){?>
                  <tr  id="table-td">
                    <td class="col-sm-2">
                        <button class="btn btn-danger btn-sm">
                      <i class="fa fa-trash"  data-toggle="modal" data-target="#myModalDelete<?= $object->getClientId();?>" id="icon-del-view"></i>
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="myModalDelete<?= $object->getClientId();?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header" id="model-painel">
                            <h4 class="modal-title" id="myModalLabel">Deletar Cliente</h4>
                          </div>
                          <div class="modal-body">
                           Deseja mesmo deletar este registro?
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Não Cancelar</button>
                            <a href="../Controller/deleteClient.php?clientId=<?= $object->getClientId();?>">
                            <button type="button" class="btn btn-success">Sim deletar</button>
                            </a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                   <!-- fim Modal -->
                  <a href="dashboardPedido.php?clientId=<?= $object->getClientId();?>">
                    <button class="btn btn-primary btn-sm">
                  <i class="fa fa-pencil" id="icon-edit-view"></i>
                  </button>
                    </a>

                  <a href="dashboardView.php?clientId=<?= $object->getClientId();?>">
                    <button class="btn btn-success btn-sm">
                  <i class="fa fa-folder-open" id="icon-edit-view"></i>
                  </button>
                    </a>
                    </td>
                    <td id="table-td" class="col-sm-5"><?= $object->getClientName();?></td>
                    <td ><?= $object->getClientContact();?></td>
                    </tr>
                  <?php }?>
                </tbody>
              </table>
            </div>
          </div>
          <!-- page end-->
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
