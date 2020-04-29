<!DOCTYPE html>

<?php
if (!isset($_SESSION)) session_start();
include("protect.php");
protect(basename(__FILE__, '.php').".php");
$mensagem ='';



if (!(isset($_GET{'delete'})) )
	$delete = ""; 
else{
	$delete = $_GET{'delete'};

	}

$servername = "Localhost";
$database = "ads_sql";
$username = "root";
$password = "";

	//criando a conexão

$conn = mysqli_connect($servername, $username, $password, $database);

if($delete != ""){
  $sql_delete = "DELETE FROM usuarios WHERE id = '".$delete."'";

  if (mysqli_query($conn,$sql_delete) === TRUE){
  $mensagem .=  '<div class="alert alert-success">Usuário removido com sucesso </div>';
  header("usuarios.php");
  }
else
$mensagem .=  '<div class="alert alert-danger">Erro ao executar. '.$sql_delete.'</div>';

}

$sql = "SELECT id, nome, nivel,usuario,email FROM  usuarios";


$result = mysqli_query($conn,$sql) ;




?>


<html lang="pt-br">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Adsumus</title>

     <?php           
        include("bibliotecas.php");
      ?>
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            
            <?php           
                include("sidebar.php");
            ?>

          </div>
        </div>

       <?php           
                include("top.php");
        ?>

  <!-- page content -->
  <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              
              <div class="title_left">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-left top_search">
                </div>
              </div>
            </div>

           <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
              <?php if ($mensagem != '') echo $mensagem;?>
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Usuarios  <a href="novousuario.php" class="btn btn-dark btn-xs"><i class="fa fa-plus m-right-sm"><i class="fa fa-user"> Novo usuario</i></i></a>
                    </h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">
                    <div class="table-responsive">
                      <table class="table table-striped jambo_table bulk_action">
                        <thead>
                          <tr class="headings">
                            
                            <th class="column-title">id </th>
                            <th class="column-title">Usuario </th>
                            <th class="column-title">Nome </th>
                            <th class="column-title">Email </th>
                            <th class="column-title">Perfil</th>
                            <th class="column-title"> </th>                         
                            
                            </th>
                            <th class="bulk-actions" colspan="7">
                              <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                            </th>
                          </tr>
                        </thead>

                        <tbody>
                        <?php
                          $i=0;
                          if ($result <> null)
                          {
                            while($row = mysqli_fetch_array($result))
                            {
                              $i++;
                              
                              
                              echo '
                              <tr class="even pointer">
                              <td >'.$row['id'].'</td>
                              <td >'.$row['usuario'].'</td>
                              <td >'.$row['nome'].'</td>
                              <td >'.$row['email'].'</td>
                              <td >'.$row['nivel'].'</td>
                              <td >
                                <a href="gerenciausuarios.php?action=show&id='.$row['id'].'" class="btn btn-warning"><i class="fa fa-edit m-right-xs"></i></a>
                                <a href="usuarios.php?delete='.$row['id'].'" class="btn btn-danger" onclick="return confirm(\'Tem certeza que deseja deletar esse usuário?\');"><i class="fa fa-trash m-right-xs"></i></a>
                              </td>
                            </tr>
                                ';                       
                            }
                        }

                        ?>
                        </tbody>
                      </table>
                      

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
        </div>
       
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
          <img src="icone_adsumus.png" width="20" height="20"/> Adsumus Softwares
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>
    <!-- jQuery custom content scroller -->
    <script src="../vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>

    <?php	
      mysqli_close($conn);	
	 
	
    ?>
 
  </body>
</html>
