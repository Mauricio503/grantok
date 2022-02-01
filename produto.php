<?php
include("conexao.php");
$sql = "select * from grupo;";
$lista_grupo = pg_query($conexao,$sql) or die("Erro");

if(isset($_GET['id'])){
    $id = "$_GET[id]";
}
$row[0] = null;
$row[1] = null;
$row[2] = null;
$row[3] = null;
$tamanho_lista_especificacoes = 0;
$resultadoLigacao = null;
if (isset($_GET['id'])){ 
    $sql = "select * from produto where id=".$id;
    $sqlLigacao = "select * from especificacao_produto where produto_id=".$id;
    $resultado = pg_query($conexao,$sql) or die("Erro");
    $resultadoLigacao = pg_query($conexao,$sqlLigacao) or die("Erro");
    $row = pg_fetch_row($resultado);
	$sqlGrupo = "select * from grupo where id=".$row[3];
	$resultadoGrupo = pg_query($conexao,$sqlGrupo) or die("Erro");
    $rowGrupo = pg_fetch_row($resultadoGrupo);
    $tamanho_lista_especificacoes = pg_num_rows($resultadoLigacao);
}
?>

<!DOCTYPE html>
<html lang="pt" amp>
<head>
	<meta charset="UTF-8">
	<title>Grantok Portas & Cabos</title>
	<link rel="alternate" hreflang="pt-br" href="alternateURL">
	<link rel="canonical" href="index.html">
	<link rel="stylesheet" type="text/css" href="css/style.css">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=1,minimum-scale=1, user-scalable=no" />
	<!--Zoom-->
	<!--http://www.rafaelwendel.com/2012/10/zoom-de-imagens-com-jqzoom/-->
	<title>JQZoom</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script src="js/jquery-1.6.js" type="text/javascript"></script>
        <script src="js/jquery.jqzoom-core.js" type="text/javascript"></script>
        <link rel="stylesheet" href="css/jquery.jqzoom.css" type="text/css">
        <script type="text/javascript">
            $(document).ready(function(){
                $('.jqzoom').jqzoom({
                    zoomType : 'standard'
                });
            })
        </script>	
        <script type="application/ld+json">
		{
	  		"@context": "http://schema.org",
	  		"@type": "Product",
	  		"name": "Cabo Ancinho",
	  		"description": "Lixado",
	  		"weight": "830g"
  	    }
  		</script>
  		</script>
		<script type="application/ld+json">
  		{
			"@context": "http://schema.org",
			"@type": "WebPage",
  			"publisher": "Maurício Spagnol"
  		}
		</script>

<style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>

<style amp-custom>
  body {
    background-color: white;
  }
</style>

<script async src="https://cdn.ampproject.org/v0.js"></script>
<script type="text/javascript" src="js/scrolltop.js"></script>
</head>
<body>
	<div id="geral">
		<?php 
			include("menu.php");
		?>
		<a href="#" class="scrollToTop"></a>
		<section>
			<h1 align="middle" id="titulo-prod"><?= $row[1]?></h1>
			<hr size="5" color=#096735 style="width: 100%">
			<br>
			<a href="img/<?= $row[0]?>.png" class="jqzoom" title="Ancinho">
			<?php 
			if($rowGrupo[1] == "Cabo"){
				echo "<img src='img/$row[0].png' title='$row[1]' class='img-zoom-cabo' alt='$row[1]'></img>";
			}else{
				echo "<img src='img/$row[0].png' title='$row[1]' class='img-zoom' alt='$row[0]'></img>";
			}
            ?>
        </a>
        <div id="especificacoes">
        	<h2 style="text-align:center">Especificações</h2><br>
			<?php 
				if($tamanho_lista_especificacoes != 0){
					echo "<table itemprop='description'>";
					echo "<thead>";
                    echo "<tr id='titulo-espe'>";
                	echo "<th scope='col'>Comprimento (m)</th>";
                    echo "<th scope='col'>Largura (cm)</th>";
                    echo "<th scope='col'>Altura (cm)</th>";
                    echo "</tr>";
                    echo "</thead>";
                    echo "<tbody>";
					while ($rowe = pg_fetch_row($resultadoLigacao)) {
						echo "<tr>";
						echo "<td>$rowe[1]</td>";
						echo "<td>$rowe[2]</td>";
						echo "<td>$rowe[3]</td>";
						echo "</tr>";
					}
					echo "</tbody>";
					echo "</table>";
				}
			?>
			
			<?=$row[2]?>
        </div>
		</section>
		<footer>
			<div id="footer">
				<div id="contato">
					<br>
					<h2>Contato</h2><br>
					<p>(49) 3434-0493<br><br>
					(49) 3434-0605<br><br></p>
					<p>atendimento@grantok.com.br</p>
				</div>
				<div id="endereco">
					<br>
					<h2>Endereço</h2><br>
					<p>Rua Sete de Setembro, 01 - Centro<br><br>
					Vargeão-SC<br><br>
					89690-000</p>
				</div>
				<div id="autoria">
					<p>Grantok - Todos os direitos reservados | Copyright 2018 <a href="https://criasystem.tech/">Maurício Spagnol</a><b>Desenvolvido por: </b></p>
				</div>
			</div>
		</footer>
	</div>
</body>
</html>