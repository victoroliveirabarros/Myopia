<?php
    
  // Verifica se houve POST e se o usuário ou a senha é(são) vazio(s)
  if (!empty($_POST) AND (empty($_POST['usuario']) OR empty($_POST['senha']))) {
      echo "aqui";
      header("Location: login.php"); exit;
  }


    $servername = "Localhost";
    $database = "ads_sql";
    $username = "root";
    $password = "";

	//criando a conexão

	$conn = mysqli_connect($servername, $username, $password, $database);

	//checando a conexão

	/*if (!$conn)
	{
		die("Connection failed: ".mysqli_connect_error());
	}*/
    
  // Tenta se conectar ao servidor MySQL
  $conn or trigger_error(mysqli_connect_error());
  // Tenta se conectar a um banco de dados MySQL
  mysqli_select_db($conn, 'usuarios') or trigger_error(mysqli_connect_error());
   
    $usuario = mysqli_real_escape_string($conn, $_POST['usuario']);
    $senha = mysqli_real_escape_string($conn, $_POST['senha']);

        // Validação do usuário/senha digitados
    $sql = "SELECT id,
                   nome,
                   nivel
            FROM
                   usuarios
            WHERE
                   (usuario = '".$usuario ."') AND (senha = '".sha1($senha)."') AND (ativo = 1) LIMIT 1";
    
    $query = mysqli_query($conn, $sql);
    if (mysqli_num_rows($query) != 1) 
    {
        // Mensagem de erro quando os dados são inválidos e/ou o usuário não foi encontrado
        header("Location: login.php?err=1"); 
        exit; // Redireciona o visitante
    } 
    else
    {
        // Salva os dados encontados na variável $resultado
        $resultado = mysqli_fetch_assoc($query);
        // Se a sessão não existir, inicia uma
        if (!isset($_SESSION)) session_start();

        // Salva os dados encontrados na sessão
        $_SESSION['UsuarioID'] = $resultado['id'];
        $_SESSION['UsuarioNome'] = $resultado['nome'];
        $_SESSION['UsuarioNivel'] = $resultado['nivel'];

        // Redireciona o visitante
        header("Location: index.php"); exit;
    }

?>