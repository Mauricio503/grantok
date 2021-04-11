<?php
session_start();
include('verifica_login.php');
include("../conexao.php");

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
                    <a class="navbar-brand"> Lista Grupos </a>
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
                                <script>
                                    function redirectNovoGrupo(){
                                        window.location.href = "grupo.php";
                                    }
                                </script>              
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Código</th>
                                            <th scope="col">Descrição</th>
                                            <th scope="col">
                                                <a class="nc-icon nc-simple-add" onclick="redirectNovoGrupo()"></a>
                                            </th>
                                        </tr>
                                    </thead>
                                        <tbody>
                                        <script>
                                            function redirectEditarGrupo(id){
                                                window.location.href = "grupo.php?acao=editar&id="+id;
                                            }
                                        </script>
                                            <?php
                                                while ($row = pg_fetch_row($lista_grupo)) {
                                                    echo "<tr>";
                                                    echo "<td scope='row'>$row[0]</td>";
                                                    echo "<td>$row[1]</td>";
                                                    echo "<td><i class='nc-icon nc-settings-90' onclick='redirectEditarGrupo($row[0])'></i></td>";
                                                    echo "</tr>";
                                                }
                                            ?>
                                            
                                        </tbody>
                                    </table>
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
<!--   Core JS Files   -->
<script src="assets/js/core/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="assets/js/core/popper.min.js" type="text/javascript"></script>
<script src="assets/js/core/bootstrap.min.js" type="text/javascript"></script>
<!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
<script src="assets/js/plugins/bootstrap-switch.js"></script>
<!--  Google Maps Plugin    -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
<!--  Chartist Plugin  -->
<script src="assets/js/plugins/chartist.min.js"></script>
<!--  Notifications Plugin    -->
<script src="assets/js/plugins/bootstrap-notify.js"></script>
<!-- Control Center for Light Bootstrap Dashboard: scripts for the example pages etc -->
<script src="assets/js/light-bootstrap-dashboard.js?v=2.0.0 " type="text/javascript"></script>
<!-- Light Bootstrap Dashboard DEMO methods, don't include it in your project! -->
<script src="assets/js/demo.js"></script>

</html>
