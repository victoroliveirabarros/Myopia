<!DOCTYPE html>

<?php

if (!isset($_SESSION)) session_start();
include("protect.php");
protect(basename(__FILE__, '.php').".php");
$mensagem ='';


$servername = "Localhost";
$database = "ads_sql";
$username = "root";
$password = "";
$conn = mysqli_connect($servername, $username, $password, $database);


if (!(isset($_POST{'action'})) )
    $action = ""; 
else
{
    $action = $_POST{'action'};
    
}

if ( $action =="edit")
{

    if (!(isset($_POST{'id'})) )
        $id = ""; 
    else
        $id = $_POST{'id'};

    if (!(isset($_POST{'nome'})) )
        $nome = ""; 
    else
        $nome = $_POST{'nome'};

    if (!(isset($_POST{'email'})) )
        $email = ""; 
    else
        $email = $_POST{'email'};

    if (!(isset($_POST{'senha'})) )
        $senha = ""; 
    else
        $senha = $_POST{'senha'};

    if (!(isset($_POST{'nivel'})) )
        $nivel = ""; 
    else
        $nivel = $_POST{'nivel'};


    //print_r($_POST['check_list_permissoes']);
    if(!empty($_POST['check_list_permissoes'])) 
    {

      $sql_delete_permissoes = "DELETE from permissoes_pagina_usuario where id_usuario = ".$id;
        
        if (mysqli_query($conn,$sql_delete_permissoes) === TRUE)
           $mensagem .=  '';
        else
      $mensagem .=  '<div class="alert alert-danger">Erro ao executar. '.$sql_delete_permissoes.'</div>';

      foreach($_POST['check_list_permissoes'] as $pagina) 
      {  
        $sql_update_permissoes = "INSERT INTO permissoes_pagina_usuario(id_permissoes_pagina,id_usuario,permitido) VALUES  ($pagina,$id,1)  ON DUPLICATE KEY UPDATE permitido = 1";
        if (mysqli_query($conn,$sql_update_permissoes) === TRUE)
           $mensagem .=  '';
        else
           $mensagem .=  '<div class="alert alert-danger">Erro ao executar. '. $sql_update_permissoes.'</div>';

      }
    }
    else{

      $sql_delete_permissoes = "DELETE from permissoes_pagina_usuario where id_usuario = ".$id;
      if (mysqli_query($conn,$sql_delete_permissoes) === TRUE)
           $mensagem .=  '<div class="alert alert-success">Permissoes removidas com sucesso </div>';
        else
      $mensagem .=  '<div class="alert alert-danger">Erro ao executar. '.$sql_delete_permissoes.'</div>';

    }
    
    if($senha =='')
      $sql_update = "UPDATE usuarios set nome = '".$nome."', email = '".$email."' where id = ".$id;
    else
      $sql_update = "UPDATE usuarios set nome = '".$nome."', email = '".$email."', senha = SHA1('".$senha."') where id = ".$id;

    if (mysqli_query($conn,$sql_update) === TRUE)
        $mensagem .=  '<div class="alert alert-success">Alteracao Efetuado com sucesso </div>';
    else
         $mensagem .=  '<div class="alert alert-danger">Erro ao executar. '.$sql_update.'</div>';
}
else
{
    if (!(isset($_GET{'id'})) )
        $id = ""; 
    else
        $id = $_GET{'id'};
}



$sql = "SELECT id, nome, nivel,usuario,email FROM  usuarios where id = ".$id;
$result = mysqli_query($conn,$sql) ;

if ($result <> null)
{
  while($row = mysqli_fetch_array($result))
  {
    $usuario = $row['usuario'];
    $nome = $row['nome'];
    $email = $row['email'];
    $nivel = $row['nivel'];
  }
}



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

            <div class="clearfix"></div>
              <div class="col-md-12 col-sm-12 col-xs-12">
                

                 
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
              <?php if ($mensagem != '') echo $mensagem;?>
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Editar usuário <small><?php echo $usuario; ?></small></h2>
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
                    <br />
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" id="usuarioform" action="gerenciausuarios.php">
                      <input type="hidden" id="id" name ="id" value="<?php echo $id;?>">
                      <input type="hidden" id="action" name ="action" value="edit">
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nome <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="nome" name="nome" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $nome;?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Email <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="email" id="email" name="email" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $email;?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Senha</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="senha" class="form-control col-md-7 col-xs-12" type="password" name="senha" >
                        </div>
                      </div>


                      <div class="form-group">
                        <div class="checkbox">

                            <?php
                            
                            $sql_paginas = 
                              "SELECT 
                              (select id_usuario from permissoes_pagina_usuario where permissoes_pagina_usuario.id_permissoes_pagina = permissoes_pagina.id and permissoes_pagina_usuario.id_usuario = ".$id." ) as Permitido,
                              permissoes_pagina.pagina,
                              permissoes_pagina.id,
                              permissoes_pagina.Nome
                              FROM permissoes_pagina";
                            // echo  '<div class="alert alert-danger">Erro ao executar. '.$sql_paginas.'</div>';
                              $result = mysqli_query($conn,$sql_paginas) ;

                              if ($result <> null)
                              {
                                while($row = mysqli_fetch_array($result))
                                {
                                  $checked='';

                                  if ($row['Permitido']==$id)
                                    $checked = 'checked="checked"';
                                  echo '
                                  <label>
                                    <input type="checkbox" name="check_list_permissoes['. $row["id"].']" class="flat" value = "'. $row["id"].'" '.$checked.'> '. $row["Nome"].'
                                  </label>';

                                }
                              }

                              mysqli_close($conn);	
                            
                            ?>   
                        </div>
                       </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="cancel" class="btn btn-danger" onclick="window.location='usuarios.php';return false;">Voltar</button>
                          <button type="submit" class="btn btn-success">Editar</button>
                        </div>
                      </div>
                    </form>
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

     <!-- iCheck -->
     <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">

    <!-- jQuery custom content scroller -->
    <script src="../vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>



    <!-- iCheck -->
    <script src="../vendors/iCheck/icheck.min.js"></script>
    


   
 
  </body>
</html>
