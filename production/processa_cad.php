<?php
session_start();
ob_start();

$servername = "Localhost";
$database = "ads_sql";
$username = "root";
$password = "";
$conn = mysqli_connect($servername, $username, $password, $database);

//Receber os dados do formulário
$dados = filter_input_array(INPUT_GET, FILTER_DEFAULT);

//Salvar os dados no bd
$result_markers = "INSERT INTO markers(name, address, lat, lng, type) 
				VALUES 
				('".$dados['name']."', '".$dados['address']."', '".$dados['lat']."', '".$dados['lng']."', '".$dados['type']."')";

$resultado_markers = mysqli_query($conn, $result_markers);
if(mysqli_insert_id($conn)){
	$_SESSION['msg'] = '<div class="alert alert-info";>Endereço cadastrado com sucesso!</div>';
	header("Location: cadastro.php");
}else{
	$_SESSION['msg'] = "<span style='color: red';>Erro: Endereço não foi cadastrado com sucesso!</span>";
	header("Location: cadastro.php");	
}
?>