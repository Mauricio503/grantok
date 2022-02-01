<?php
include("conexao.php");
$grupo = null;
if(isset($_GET['grupo'])){
    $grupo = "$_GET[grupo]";
    $sql = "select * from produto p join grupo g on (p.grupo_id=g.id) where p.grupo_id=".$grupo;
}else{
    $sql = "select * from produto p join grupo g on (p.grupo_id=g.id);";
}

$lista = pg_query($conexao,$sql) or die("Erro");
$sql = "select * from grupo;";
$lista_grupo = pg_query($conexao,$sql) or die("Erro");


?>

<!DOCTYPE html>
<html lang="pt" amp>
<head>
	<meta charset="UTF-8">
	<title>Grantok Portas & Cabos</title>
	<link rel="alternate" hreflang="pt-br" href="alternateURL">
	<!--Link Mais Informações https://codyhouse.co/gem/css-product-quick-view/-->
		<link rel="stylesheet" href="css/reset.css"> <!-- CSS reset -->
	<link rel="stylesheet" href="css/style-quick-view.css"> <!-- Resource style -->
	<script src="js/modernizr.js"></script> <!-- Modernizr -->

	<script src="js/jquery-2.1.1.js"></script>
	<script src="js/velocity.min.js"></script>
	<script src="js/main.js"></script> <!-- Resource jQuery -->
    <!--Fim Link Mais Informações-->
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=1,minimum-scale=1, user-scalable=no" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

	<script type="application/ld+json">
	{
  		"@context": "http://schema.org",
  		"@type": "SomeProducts",
  		"url": ["http://grantok.com.br/hdf.html","http://grantok.com.br/hdf-frisada.html","http://grantok.com.br/bbb-eucalipto-puxador.html","http://grantok.com.br/bbb-eucalipto-fechadura.html","http://grantok.com.br/angelim.html","http://grantok.com.br/angelim-gr19.html","http://grantok.com.br/bbb.html","http://grantok.com.br/bbb-eucalipto-vigia.html","http://grantok.com.br/externa-tauari.html","http://grantok.com.br/externa-pinus.html","http://grantok.com.br/externa-mista.html","http://grantok.com.br/angelim-frisada-gr18.html","http://grantok.com.br/correr.html","http://grantok.com.br/mdf-frisada-gr18.html","http://grantok.com.br/mdf-frisada-gr19.html","http://grantok.com.br/mdf-frisada-gr20.html","http://grantok.com.br/mdf.html","http://grantok.com.br/pintura.html","http://grantok.com.br/pintura-eucalipto.html","http://grantok.com.br/ancinho.html","http://grantok.com.br/cavadeira.html","http://grantok.com.br/enxada-cabecuda.html","http://grantok.com.br/enxada-oval.html","http://grantok.com.br/enxada-redondo.html","http://grantok.com.br/enxadao.html","http://grantok.com.br/foice.html","http://grantok.com.br/machado.html","http://grantok.com.br/marreta.html","http://grantok.com.br/martelo.html","http://grantok.com.br/pa-curvo.html","http://grantok.com.br/pa-reto.html","http://grantok.com.br/pa-y.html","http://grantok.com.br/picareta.html","http://grantok.com.br/vassoura.html"]
  	}
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
			<div class="sub-menu">
				<ul>
				<?php
					if($grupo == null){
						echo "<li><a href='produtos.php' class='submenu-todos'>Todos</a></li>";
					}else{
						echo "<li><a href='produtos.php'>Todos</a></li>";	
					}

					while ($rowg = pg_fetch_row($lista_grupo)) {
                        if($rowg[0] == $grupo){
                            echo "<li><a href='produtos.php?grupo=$rowg[0]' class='submenu-todos'>$rowg[1]</a></li>";
                        }else{
							echo "<li><a href='produtos.php?grupo=$rowg[0]'>$rowg[1]</a></li>";
						}
                    }
				?>
				</ul>
			</div>
			<!-- Visualização do mais informações:https://codyhouse.co/gem/css-product-quick-view/ -->
			<?php 
				while ($rowp = pg_fetch_row($lista)) {
					echo "<div id='prod'>";
				  	echo "<a href='produto.php?id=$rowp[0]'>";
					if($rowp[6] == "Cabo"){
						echo "<img src='img/$rowp[0].png' alt='$rowp[1]' style='width: 90%;margin-left: 5%;'></img>";
					}else{
						echo "<img src='img/$rowp[0].png' alt='$rowp[1]' style='width: 90%;height: 80%;margin-left: 5%;'></img>";
					}
					echo "<li class='cd-item'>";
					echo "<a href='produto.php?id=$rowp[0]' class='cd-trigger'>Mais Informações</a>";
					echo "</li>";
					echo "<p style='text-align:center'>$rowp[1]</p>";
					echo "</a>";
					echo "</div>";
                }
            ?>
			
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