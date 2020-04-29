
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Adsumus </title>

    <?php

    include("bibliotecas.php");

    ?>
  </head>
  <?php 

  if (!(isset($_GET{'err'})) )
    $err = ""; 
  else
  {
    $err = $_GET{'err'};
  }

  ?>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
          <?php  if($err==1) echo '<div class="alert alert-danger">Login Inválido</div>'; ?>
            <form action="valida.php" method="post">
              <h1>Myopia</h1>
              <div>
                <input type="text" class="form-control" name="usuario" placeholder="Username" required="" />
              </div>
              <div>
                <input type="password" class="form-control" name="senha" placeholder="Password" required="" />
              </div>
              <div>
                <button class="btn btn-default" value="Entrar" type="submit">Entrar</button>
                <a class="reset_pass" href="#">Esqueceu sua senha?</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
  

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><img src="icone_adsumus.png" width="30" height="30"/> Adsumus</h1>
                  <p>©2018 Todos os Direitos Reservados. </p>
                </div>
              </div>
            </form>
          </section>
        </div>

        <!--div id="register" class="animate form registration_form">
          <section class="login_content">
            <form method="post" action="valida.php">
              <h1>Criar Conta</h1>
              <div>
                <input type="text" class="form-control" name="user" placeholder="Username" required="" />
              </div>
              <div>
                <input type="email" class="form-control" name="email" placeholder="Email" required="" />
              </div>
              <div>
                <input type="password" class="form-control" name="senha" placeholder="Password" required="" />
              </div>
              <div>
                <a class="btn btn-default submit" value="Criar" name="cadastrar">Criar</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Já é membro?
                  <a href="#signin" class="to_register"> Entrar </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                <h1><img src="icone_adsumus.png" width="30" height="30"/> Adsumus</h1>
                  <p>©2018 Todos os Direitos Reservados. </p>
                </div-->
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
<?php







?>
</body>
</html>