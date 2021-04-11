<?php
session_start();
include('verifica_login.php');
include("../conexao.php");


if(isset($_GET['id'])){
    $id = "$_GET[id]";
}
$row[1] = null;
if (isset($_GET['acao']) && ($_GET['acao'] == 'editar')){ 
    $sql = "select * from grupo where id=".$id;
    $sqlLigacao = "select count(id) from produto where grupo_id=".$id;
    $resultado = pg_query($conexao,$sql) or die("Erro");
    $resultadoLigacao = pg_query($conexao,$sqlLigacao) or die("Erro");
    $row = pg_fetch_row($resultado);
    $rowLigacao = pg_fetch_row($resultadoLigacao);
}
?>
<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Grantok - Painel Administrativo</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/light-bootstrap-dashboard.css?v=2.0.0 " rel="stylesheet" />
    <link href="assets/css/demo.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script>

</head>

<body>
<?php 
    if($row[1] == null){
        echo "<form action='grupo_controller.php?acao=inserir' method='POST' enctype='multipart/form-data'>";
    }else{
        echo "<form action='grupo_controller.php?acao=alterar&id=$row[0]' method='POST' enctype='multipart/form-data'>";
    }
?>

    <div class="wrapper">
        <?php
            include("menu.php")
        ?>
        <div class="main-panel">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg " color-on-scroll="500">
                <div class="container-fluid">
                    <a class="navbar-brand"> Grupo </a>
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
                                </div>
                                <div class="card-body all-icons">
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" placeholder="Descrição"
                                            aria-describedby="basic-addon1" name="descricao" value="<?=$row[1];?>">
                                    </div>
                                </div>
                                
                            </div>
                        </div>                        
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                </div>
                                <div class="card-body all-icons">
                                    
                                    <div class="col-md-12">
                                    <script>
                                        function excluir(size,id){
                                            if(size !== 0){
                                                alert("Não é possivel excluir porque existe produtos ligado a este produto favor excluir os mesmos para executar esta exclusão")
                                            }else{
                                                window.location.href = "grupo_controller.php?acao=excluir&id="+id;
                                            }
                                        }
                                    </script>
                                        <?php 
                                            if($row[1] == null){
                                                echo "<button type='submit' class='btn btn-success' style='float:right'>Salvar</button>";
                                            }else{
                                                echo "<button type='submit' class='btn btn-success' style='float:right'>Alterar</button>";
                                                echo "<button type='button' class='btn btn-danger' style='float:right;margin-right: 15px;' onclick='excluir($rowLigacao[0],$row[0])'>Excluir</button>";
                                            }
                                        ?>
                                        <a type="button" class='btn btn-light' style="float:right;margin-right: 15px;"
                                            href="grupos.php">Voltar</a>
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
                                    </form>
</body>
<script src="assets/js/core/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="assets/js/core/popper.min.js" type="text/javascript"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
<script src="assets/js/plugins/bootstrap-switch.js"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
<script src="assets/js/plugins/chartist.min.js"></script>
<script src="assets/js/plugins/bootstrap-notify.js"></script>
<script src="assets/js/light-bootstrap-dashboard.js?v=2.0.0 " type="text/javascript"></script>
<script src="assets/js/demo.js"></script>

</html>
