<?php
    include("../conexao.php");

    if(isset($_GET['id'])){
		$id = "$_GET[id]";
	}

	if(isset($_POST['titulo'])){
		$titulo = "$_POST[titulo]";
	}
	if(isset($_POST['descricao'])){
		$descricao = "$_POST[descricao]";
	}

    if(isset($_POST['grupo'])){
		$grupo = "$_POST[grupo]";
	}

    if(isset($_POST['select_slide'])){
		$select_slide = "$_POST[select_slide]";
	}

    function Redirect($url, $permanent = false)
    {
        header('Location: ' . $url, true, $permanent ? 301 : 302);
        exit();
    }

	if (isset($_GET['acao']) && ($_GET['acao'] == 'inserir')){ 

        $sql = "insert into produto(titulo,descricao,grupo_id,mostrar_carousel) values('$titulo','$descricao','$grupo','$select_slide') returning *;";
        $resultado = pg_query($conexao,$sql) or die(pg_last_error($conexao));
        $row = pg_fetch_row($resultado);
        $id_produto =  $row[0];

        if(isset($_POST['tamanho_tabela'])){
            $tamanho_tabela = "$_POST[tamanho_tabela]";
        }
        for($i=0;$i<$tamanho_tabela;$i++){
            echo '<h1>line'.$i.'</h1>';
            $comprimento = $_POST['line'.$i][0];
            $largura = $_POST['line'.$i][1];
            $altura = $_POST['line'.$i][2];
            $sqlEspecificacoes = "insert into especificacao_produto(comprimento,largura,altura,produto_id) values('$comprimento','$largura','$altura','$id_produto');";
            pg_query($conexao,$sqlEspecificacoes) or die(pg_last_error($conexao));
        }
        if(isset($_FILES['fileUpload']))
            {
                $ext = strtolower(substr($_FILES['fileUpload']['name'],-4)); 
                $new_name = $id_produto . ".png";
                $dir = '../img/'; 

                move_uploaded_file($_FILES['fileUpload']['tmp_name'], $dir.$new_name); 
                Redirect("/admin/produtos.php", false);
            }
	}

    if (isset($_GET['acao']) && ($_GET['acao'] == 'alterar')){ 

        $sql = "update produto set titulo='$titulo',descricao='$descricao',grupo_id=$grupo,mostrar_carousel=$select_slide where id=$id;";
        pg_query($conexao,$sql) or die(pg_last_error($conexao));
        
        $sqlExclusao = "delete from especificacao_produto where produto_id=$id";
        pg_query($conexao,$sqlExclusao) or die(pg_last_error($conexao));
        $id_produto =  $id;

        if(isset($_POST['tamanho_tabela'])){
            $tamanho_tabela = "$_POST[tamanho_tabela]";
        }
        for($i=0;$i<$tamanho_tabela;$i++){
            $comprimento = $_POST['line'.$i][0];
            $largura = $_POST['line'.$i][1];
            $altura = $_POST['line'.$i][2];
            $sqlEspecificacoes = "insert into especificacao_produto(comprimento,largura,altura,produto_id) values('$comprimento','$largura','$altura','$id_produto');";
            pg_query($conexao,$sqlEspecificacoes) or die(pg_last_error($conexao));
        }
        if(isset($_FILES['fileUpload']))
            {
                $ext = strtolower(substr($_FILES['fileUpload']['name'],-4)); 
                $new_name = $id_produto . ".png";
                $dir = '../img/'; 

                move_uploaded_file($_FILES['fileUpload']['tmp_name'], $dir.$new_name); 
                Redirect("/admin/produtos.php", false);
            }else{
                Redirect("/admin/produtos.php", false);
            }
	}

    if (isset($_GET['acao']) && ($_GET['acao'] == 'excluir')){ 

        $sqlExclusao = "delete from especificacao_produto where produto_id=".$id;
        pg_query($conexao,$sqlExclusao) or die(pg_last_error($conexao));
        $sql = "delete from produto where id=".$id;
        pg_query($conexao,$sql) or die(pg_last_error($conexao));
        $dir = "../img/$id.png";
        unlink($dir);
        Redirect("/admin/produtos.php", false);
	}
?>