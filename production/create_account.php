<?php
session_start();
ob_start();
include_once("conexao.php");

//Receber os dados do formulário
$dados = filter_input_array(INPUT_GET, FILTER_DEFAULT);

$result_cad = "INSERT INTO access(username, senha, email) 
				VALUES 
				('".$dados['username']."', '".$dados['senha']."', '".$dados['email']."')";
	


if(mysqli_insert_id($conn)){
	$_SESSION['msg2'] = '<div class="alert alert-info";>Login cadastrado com sucesso!</div>';
	header("Location: login.php#signup");
}

else
{
	$_SESSION['msg2'] = "<span style='color: red';>Erro: Login não cadastrado com sucesso!</span>";
	header("Location: login.php#signup");
}


?>