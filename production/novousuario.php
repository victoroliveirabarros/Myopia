<!DOCTYPE html>

<?php

 // A sessão precisa ser iniciada em cada página diferente
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

if ( $action =="new")
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

    if (!(isset($_POST{'usuario'})) )
        $usuario = ""; 
    else
        $usuario = $_POST{'usuario'};
 
    
     $sql_insert = "INSERT INTO usuarios (usuario,nome,nivel,email,senha) values('".$usuario."','".$nome."','".$nivel."','".$email."',SHA1('".$senha."'))";
    

    if (mysqli_query($conn,$sql_insert) === TRUE)
        $mensagem =  '<div class="alert alert-success">Usuario cadastrado com sucesso </div>';
    else
         $mensagem =  '<div class="alert alert-danger">Erro ao executar. '.$sql_update.'</div>';

}

else
{
    $usuario='';
    $nome='';
    $email='';
    $nivel=0;

}


mysqli_close($conn);	

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
                    <h2>Novo usuario</h2>
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
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" id="usuarioform" action="novousuario.php">
                      <input type="hidden" id="action" name ="action" value="new">
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Usuario <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="usuario" name="usuario" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $nome;?>">
                        </div>
                      </div>
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
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Senha <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="senha" class="form-control col-md-7 col-xs-12" type="password" name="senha" required="required" >
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Nivel Permissao <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="select2_single form-control" id = 'nivel' name = 'nivel' tabindex="-1" required="required">
                            <option value="1" <?php if($nivel == 1) echo "selected";?>>1 - Basico</option>
                            <option value="2" <?php if($nivel == 2) echo "selected";?>>2 - Intermediario</option>
                            <option value="3" <?php if($nivel == 3) echo "selected";?>>3 - Administrador</option>
                          </select>
                        </div>
                      </div>

                      
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <button type="cancel" class="btn btn-danger" onclick="window.location='usuarios.php';return false;">Voltar</button>
                          <button type="submit" class="btn btn-success">Salvar</button>
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
            Adsumus Softwares
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
