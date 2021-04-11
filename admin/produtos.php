<?php
session_start();
include('verifica_login.php');
include("../conexao.php");
$grupo = null;
if(isset($_GET['grupo'])){
    $grupo = "$_GET[grupo]";
    $sql = "select * from produto p join grupo g on (p.grupo_id=g.id) where grupo_id=".$grupo;
}else{
    $sql = "select * from produto p join grupo g on (p.grupo_id=g.id);";
}

$lista = pg_query($conexao,$sql) or die("Erro");
$sql = "select * from grupo;";
$lista_grupo = pg_query($conexao,$sql) or die("Erro");


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Grantok - Painel Administrativo</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <!-- CSS Files -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/light-bootstrap-dashboard.css?v=2.0.0 " rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="assets/css/demo.css" rel="stylesheet" />
</head>

<body>
    <div class="wrapper">
        <?php
            include("menu.php")
        ?>
        <div class="main-panel">
            <nav class="navbar navbar-expand-lg " color-on-scroll="500">
                <div class="container-fluid">
                    <a class="navbar-brand"> Produto </a>
                    <div class="col-md-3" id="navigation">
                        <ul class="nav navbar-nav mr-auto" style="float:right">
                            <li class="nav-item">
                                <a class="nav-link" href="https://grantok.com.br">
                                    <span class="no-icon">Sair</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- End Navbar -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                <script>
                                        function addGrupo(id){
                                            if(id===0){
                                                window.location.href = "produtos.php";
                                            }else{
                                                window.location.href = "produtos.php?grupo="+id;
                                            }
                                        }
                                    </script>
                                    <input name="grupo" id="grupo" type="hidden"/>
                                    <?php
                                        echo "<table>
                                        <tr>";
                                        echo "<td>";
                                        if($grupo == null){
                                            echo "<input type='radio' class='btn-check' checked name='options' id='option0' autocomplete='off'>";
                                        }else{
                                            echo "<input type='radio' class='btn-check' name='options' id='option0' autocomplete='off'>";
                                        }
                                        echo "<label class='btn btn-outline-success' style='color:black;margin-left: 10px;' onclick='addGrupo(0)' for='option0'>Todos</label>";
                                        echo "</td>";
                                        while ($row = pg_fetch_row($lista_grupo)) {
                                            echo "<td>";
                                            if($row[0] == $grupo){
                                                echo "<input type='radio' class='btn-check' checked name='options' id='option$row[0]' autocomplete='off'>";
                                            }else{
                                                echo "<input type='radio' class='btn-check' name='options' id='option$row[0]' autocomplete='off'>";
                                            }
                                            echo "<label class='btn btn-outline-success' style='color:black;margin-left: 10px;' onclick='addGrupo($row[0])' for='option$row[0]'>$row[1]</label>";
                                            echo "</td>";
                                        }
                                        echo "<td><a class='nc-icon nc-simple-add' href='grupo.php' style='text-decoration: none;'></a></td>";
                                        echo "</tr>
                                        </table>";
                                    ?>
                                </div>
                                <a href="produto.php"><button type="button" class="btn btn-success" style="margin-left: 27px;"><i class="nc-icon nc-simple-add"></i> Novo Produto</button></a>
                                <div class="card-body all-icons">
                                    <div class="row">
                                    <script>
                                            function redirectEditarProduto(id){
                                                window.location.href = "produto.php?acao=editar&id="+id;
                                            }
                                        </script>
                                    <?php 
                                        while ($row = pg_fetch_row($lista)) {
                                            echo "<div class='font-icon-list col-lg-2 col-md-3 col-sm-4 col-6'>";
                                            echo "<div class='font-icon-detail' style='padding:0'>";
                                            if($row[6] == "Cabo"){
                                                echo "<img src='../img/$row[0].png' style='width:100%;'/>";
                                            }else{
                                                echo "<img src='../img/$row[0].png' style='width:100%;height:170px;'/>";
                                            }
                                            echo "<p>$row[1]</p>";
                                            echo "<i class='nc-icon nc-settings-90' style='font-size:25px;' onclick='redirectEditarProduto($row[0])'></i>";
                                            echo "</div>";
                                            echo "</div>";
                                        }
                                    ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php 
                include("footer.php")
            ?>
        </div>
    </div>
</body>
<script src="assets/js/core/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="assets/js/core/popper.min.js" type="text/javascript"></script>
<script src="assets/js/plugins/bootstrap-switch.js"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
<script src="assets/js/plugins/chartist.min.js"></script>
<script src="assets/js/plugins/bootstrap-notify.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

<script src="assets/js/light-bootstrap-dashboard.js?v=2.0.0 " type="text/javascript"></script>
<script src="assets/js/demo.js"></script>

</html>
