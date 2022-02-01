<?php
include("conexao.php");
$sql = "select * from produto;";

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
	<link rel="canonical" href="index.html">
	<link href="css/style.css" rel="stylesheet" type="text/css">
	<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=1,minimum-scale=1, user-scalable=no" />

		<!--Link Mais Informações https://codyhouse.co/gem/css-product-quick-view/-->

	<link rel="stylesheet" type="text/css" href="css/style-quick-view.css"> <!-- Resource style -->
	<script src="js/modernizr.min.js"></script> <!-- Modernizr -->

	<script src="js/jquery-2.1.1.min.js"></script>
	<script src="js/velocity.min.js"></script>
	<script src="js/main.min.js"></script> <!-- Resource jQuery -->
    <!--Fim Link Mais Informações-->

			<!--Slider-->
			<!--https://bkosborne.com/jquery-waterwheel-carousel-->
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Slider Portas(Carousel)</title>
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="js/jquery.waterwheelCarousel.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function () {
        var carousel = $("#carousel").waterwheelCarousel({
          flankingItems: 2,
          movingToCenter: function ($item) {
            $('#callback-output').prepend('movingToCenter: ' + $item.attr('id') + '<br/>');
          },
          movedToCenter: function ($item) {
            $('#callback-output').prepend('movedToCenter: ' + $item.attr('id') + '<br/>');
          },
          movingFromCenter: function ($item) {
            $('#callback-output').prepend('movingFromCenter: ' + $item.attr('id') + '<br/>');
          },
          movedFromCenter: function ($item) {
            $('#callback-output').prepend('movedFromCenter: ' + $item.attr('id') + '<br/>');
          },
          clickedCenter: function ($item) {
            $('#callback-output').prepend('clickedCenter: ' + $item.attr('id') + '<br/>');
          }
        });

        $('#prev').bind('click', function () {
          carousel.prev();
          return false
        });

        $('#next').bind('click', function () {
          carousel.next();
          return false;
        });

        $('#reload').bind('click', function () {
          newOptions = eval("(" + $('#newoptions').val() + ")");
          carousel.reload(newOptions);
          return false;
        });

      });
    </script>
		<!--Fim Slider-->
		<script type="application/ld+json">
{
  "@context": "http://schema.org",
  "@type": "Organization",
  "url": "http://www.grantok.com.br",
  "name": "Grantok Portas e Cabos",
  "email": "atendimento@grantok.com.br",
  "image": "http://grantok.com.br/img/logo-maior.png",
  "address":{
    "@type":"PostalAddress",
    "streetAddress":"Rua Sete de Setembro 01 - Centro",
    "addressLocality":"Vargeão",
    "addressRegion":"SC",
    "postalCode":"89690-000",
    "addressCountry":"BR"
  },
  "telephone": "+55 49 3434-0493"
  }
</script>
<script type="application/ld+json">
  {
	"@context": "http://schema.org",
	"@type": "WebPage",
  	"publisher": "Maurício Spagnol"
  }
</script>

<script type="application/ld+json">
  "openingHoursSpecification": [
  {
    "@type": "OpeningHoursSpecification",
    "dayOfWeek": [
      "Monday",
      "Tuesday",
      "Wednesday",
      "Thursday",
      "Friday"
    ],
    "opens": "07:42",
    "closes": "18:00"
  },
 ]
</script>
<style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>
<style amp-custom>
  body {
    background-color: white;
  }
</style>

<script async src="https://cdn.ampproject.org/v0.js"></script>
<script type="text/javascript" src="js/scrolltop.min.js"></script>
</head>
<body>
	<div id="geral">
		<?php  
			include("menu.php")
		?>
		
		<a href="#" class="scrollToTop"></a>
		<!--Slider-->		
		<div align="middle">
		<table>
			<tr>
    	</tr>
    	</table>
    	</div>
		<!--Fim Slider-->
		
		<?php
		include("3DCarousel/index.php");
		?>
		<section style="margin-top: 10%;"> 
			<h2 id="titulo-produtos">Categorias</h2>

			<style>
				@import url('//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css');
#categorias{
  display: flex;
  align-items: center;
  justify-content: center;
  min-height: 100vh;
  background: white;
}
#categorias ul {
   position: relative;
   display: flex;
   transform: rotate(-15deg) skew(25deg);
   transform-style: preserve-3d;
}
#categorias ul li {
  position: relative;
  list-style: none;
  width: 150px;
  height: 60px;
  margin: 0px 20px;
}
#categorias ul li:before{
  content: '';
  position: absolute;
  bottom: -10px;
  left: -5px;
  width: 100%;
  height: 10px;
  background: #2a2a2a;
  trnasform-origin: top;
  transform: skewX(-41deg);
}
#categorias ul li:after{
  content: '';
  position: absolute;
  top:5px;
  left: -9px;
  width: 9px;
  height: 100%;
  background: #2a2a2a;
  trnasform-origin: right;
  transform: skewY(-49deg);
}
#categorias ul li span{
  position: absolute;
  top: 0;
  lef: 0;
  width: 100%;
  height: 100%;
  display: flex !important;
  background: #2a2a2a;
  justify-content: center;
  align-items: center;
  color: #fff;
  font-size: 30px !important;
  transition: 1.5s ease-out;
}
#categorias ul li:hover span {
  z-index: 1000;
  transition: .3s;
  color: #fff;
  box-shadw: -1px 1px 1px rgba(0, 0, 0, .5);
}
#categorias ul li:hover span:nth-child(5){
  transform: translate(40px, -40px);
  opacity: 1;
}
#categorias ul li:hover span:nth-child(4){
  transform: translate(30px, -30px);
  opacity: .8;
}
#categorias ul li:hover span:nth-child(3){
  transform: translate(20px, -20px);
  opacity: .6;
}
#categorias ul li:hover span:nth-child(2){
  transform: translate(10px, -10px);
  opacity: .4;
}
#categorias ul li:hover span:nth-child(1){
  transform: translate(0px, 0px);
  opacity: .2;
}
				</style>

			<div id="categorias">
  <ul> 
	<?php 
	 while ($rowg = pg_fetch_row($lista_grupo)) {
		 echo "<li>";
		 echo "<a href='produtos.php?grupo=$rowg[0]'>";
		 echo "<span></span>";
		 echo "<span></span>";
		 echo "<span></span>";
		 echo "<span></span>";
		 echo "<span>$rowg[1]</span>";
		 echo "</a>";
		 echo "</li>";
	 }
	?>
    
  </ul>  
</div> 
			
		</section>
		<footer>
			<div id="footer">
				<div id="contato">
					<br>
					<h2>Contato</h2>
					<br>
					<p>(49) 3434-0493<br><br>
					(49) 3434-0605<br><br></p>
					<p>atendimento@grantok.com.br</p>
				</div>
				<div id="endereco">
					<br>
					<h2>Endereço</h2>
					<br>
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