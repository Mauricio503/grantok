<?php
	session_start();
	include("../conexao.php");
	if(empty($_POST['usuario']) || empty($_POST['senha'])){
		header('Location: index.php');
		exit();
	}
	if(isset($_POST['usuario'])){
		$usuario = "$_POST[usuario]";
	}
	if(isset($_POST['senha'])){
		$senha = "$_POST[senha]";
	}

	$sql = "select * from usuario where login = '$usuario' and senha = md5('$senha')";
    $resultado = pg_query($conexao,$sql) or die("Erro");
    $row = pg_num_rows($resultado);

	if($row == 1){
		$_SESSION['usuario'] = $usuario;
		header('Location: produtos.php');
		exit();
	} else {
		$_SESSION['nao_autenticado'] = true;
		header("Location: login.php");
		exit();
	}
?>