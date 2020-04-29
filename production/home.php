<?php
 // A sessão precisa ser iniciada em cada página diferente
 // A sessão precisa ser iniciada em cada página diferente
 if (!isset($_SESSION)) session_start();
 include("protect.php");
 protect(basename(__FILE__, '.php').".php");
 $mensagem ='';



//get 
if(!(isset($_GET{'search'})))
	$search = "";
else {
	$search = $_GET{'search'};
	//echo $search;
}

if(!(isset($_GET{'delete'})))
	$nomer = "";
else {
	$nomer = $_GET{'delete'};
	//echo $nomer;
}


$servername = "Localhost";
$database = "ads_sql";
$username = "root";
$password = "";
$conn = mysqli_connect($servername, $username, $password, $database);



if($nomer != ""){
  $sql_erase = "DELETE FROM markers WHERE id = '".$nomer."'";

  if (mysqli_query($conn,$sql_erase) === TRUE){
  $mensagem .=  '<div class="alert alert-success">Cadastro removido com sucesso </div>';
  header("home.php");
  }
else
$mensagem .=  '<div class="alert alert-danger">Erro ao executar. '.$sql_erase.'</div>';

}

  
      $sql = "SELECT
        id,
        name,
        address,
        lat,
        lng,
        type
        
      FROM
        markers";
        
    $res = mysqli_query($conn, $sql);







?>
<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title> Adsumus </title>

    <?php

    include("bibliotecas.php");

    ?>

  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col menu_fixed">
          <div class="left_col scroll-view">

        <?php

        include("sidebar.php");

        ?>
            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
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

            <div class="clearfix"></div>
              <div class="col-md-12 col-sm-12 col-xs-12">
              <?php if ($mensagem != '') echo $mensagem;?>
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Consulta Clientes</h2>
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
							  
						 	            <th class="column-title">ID </th>
                        	<th class="column-title">Nome </th>
                          <th class="column-title">Endereço </th>
                        	<th class="column-title">Latitude </th>
                          <th class="column-title">Longitude </th>
                        	<th class="column-title">Tipo </th>
                          <th class="column-title"> </th>
                            
                            </th>
                            <th class="bulk-actions" colspan="7">
                              <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                            </th>
                          </tr>
                        </thead>

                        <tbody>
                        <?php
                          //consulta no banco

                              if($sql <> null){
                              while($row = mysqli_fetch_array($res))
                              {
                                echo '<tr>
                                  <td>'.$row['id'].'</td>
                                  <td>'.$row['name'].'</td>
                                  <td>'.$row['address'].'</td>
                                  <td>'.$row['lat'].'</td>
                                  <td>'.$row['lng'].'</td>
                                  <td>'.$row['type'].'</td>
                                  <td><a href="home.php?delete='.$row['id'].'" class="btn btn-danger" onclick="return confirm(\'Tem certeza que deseja deletar esse usuário?\');"><i class="fa fa-trash m-right-xs"></i></a></td>
                                  </tr>';
                              }	

                          //<td><button type="submit" onclick="DELETE FROM cadastro WHERE id='.$nomer.'" class="btn btn-danger">Apagar</button></td>		
                          //<img src="lixeira.png" width="20" height="20"/><input type="text" name="nomer" id="nomer"><input type="submit" value="Excluir"></td>
                          
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

  </body>
</html>
