<?php
    include("../conexao.php");


    if(isset($_GET['id'])){
		$id = "$_GET[id]";
	}
	if(isset($_POST['descricao'])){
		$descricao = "$_POST[descricao]";
	}
    function Redirect($url, $permanent = false)
    {
        header('Location: ' . $url, true, $permanent ? 301 : 302);
        exit();
    }

	if (isset($_GET['acao']) && ($_GET['acao'] == 'inserir')){ 
        $sql = "insert into grupo(descricao) values('$descricao') returning *;";
        pg_query($conexao,$sql) or die(pg_last_error($conexao));
        Redirect("/admin/grupos.php", false);
    }
    if (isset($_GET['acao']) && ($_GET['acao'] == 'alterar')){ 
        $sql = "update grupo set descricao='$descricao' where id=$id";
        pg_query($conexao,$sql) or die(pg_last_error($conexao));
        Redirect("/admin/grupos.php", false);
    }
    if (isset($_GET['acao']) && ($_GET['acao'] == 'excluir')){ 
        $sql = "delete from grupo WHERE id=$id";
        pg_query($conexao,$sql) or die(pg_last_error($conexao));
        Redirect("/admin/grupos.php", false);
    }
?>