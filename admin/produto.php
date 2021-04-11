<?php
session_start();
include('verifica_login.php');
include('../conexao.php');
$sql = "select * from grupo;";
$lista_grupo = pg_query($conexao,$sql) or die("Erro");

if(isset($_GET['id'])){
    $id = "$_GET[id]";
}
$row[0] = null;
$row[1] = null;
$row[2] = null;
$row[3] = null;
$tamanho_lista = 0;
$resultadoLigacao = null;
if (isset($_GET['acao']) && ($_GET['acao'] == 'editar')){ 
    $sql = "select * from produto where id=".$id;
    $sqlLigacao = "select * from especificacao_produto where produto_id=".$id;
    $resultado = pg_query($conexao,$sql) or die("Erro");
    $resultadoLigacao = pg_query($conexao,$sqlLigacao) or die("Erro");
    $row = pg_fetch_row($resultado);
    $tamanho_lista = pg_num_rows($resultadoLigacao);
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
    <link href="assets/css/light-bootstrap-dashboard.css?v=2.0.0 " rel="stylesheet" />
    <link href="assets/css/demo.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script>

</head>

<body>
<?php 
    if($row[1] == null){
        echo "<form action='produto_controller.php?acao=inserir' method='POST' enctype='multipart/form-data'>";
    }else{
        echo "<form action='produto_controller.php?acao=alterar&id=$row[0]' method='POST' enctype='multipart/form-data'>";
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
                                </div>
                                <div class="card-body all-icons">
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" placeholder="Titulo"
                                            aria-describedby="basic-addon1" name="titulo" value="<?=$row[1];?>"
                                            required>
                                           
                                    </div>
                                    <h5 style="padding-top:15px">Grupos</h5>
                                    <script>
                                        function addGrupo(id){
                                            document.getElementById("grupo").value = id;
                                        }
                                    </script>
                                    <input name="grupo" id="grupo" type="hidden" value="<?=$row[3];?>"/>
                                    
                                    <?php
                                        echo "<table>
                                        <tr>";
                                        while ($rowg = pg_fetch_row($lista_grupo)) {
                                            echo "<td>";
                                            if($rowg[0] == $row[3]){
                                                echo "<input type='radio' class='btn-check' checked name='options' id='option$rowg[0]' autocomplete='off' required>";
                                            }else{
                                                echo "<input type='radio' class='btn-check' name='options' id='option$rowg[0]' autocomplete='off' required>";
                                            }
                                            
                                            echo "<label class='btn btn-outline-success' style='color:black;margin-left: 10px;' onclick='addGrupo($rowg[0])' for='option$rowg[0]'>$rowg[1]</label>";
                                            echo "</td>";
                                        }
                                        echo "<td><a class='nc-icon nc-simple-add' href='grupo.php' style='text-decoration: none;'></a></td>";
                                        echo "</tr>
                                        </table>";
                                    ?>
                                    </div>

                                    <div class="col-md-4" style="margin-left: 28px;">
                                        <label>Utilizar no Slide da Tela Inicial?</label>
                                        <select class="form-select" name="select_slide" aria-label="Default select example">
                                            
                                            <?php     
                                                if(strval($row[4]) == "t"){
                                                    echo "<option value='false'>Não</option>";
                                                    echo "<option value='true' selected>Sim</option>";
                                                }else{
                                                    echo "<option value='false' selected>Não</option>";
                                                    echo "<option value='true'>Sim</option>";
                                                }
                                            ?>
                                            
                                        </select>
                                    </div>
                            </div>
                        </div>
                    <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Foto</h4>
                                </div>
                                <div class="card-body all-icons">
                                    <img id="blah" alt="Imagem Upload" style="width:100%;" src="../img/<?=$row[0]?>.png"/>
                                    <input type='file' id="imgInp" name="fileUpload" src="../img/<?=$row[0]?>.png"/>
                                </div>
                                
                                <script>
                                    function readURL(input) {
                                        if (input.files && input.files[0]) {
                                            var reader = new FileReader();
                                            
                                            reader.onload = function(e) {
                                            $('#blah').attr('src', e.target.result);
                                            }
                                            
                                            reader.readAsDataURL(input.files[0]); // convert to base64 string
                                        }
                                        }

                                        $("#imgInp").change(function() {
                                        readURL(this);
                                        });
                                </script>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Especificações</h4>
                                </div>
                                <div class="card-body all-icons">
                                    <script>
                                        function addLine(){
                                            var tableRef = document.getElementById('tabela').getElementsByTagName('tbody')[0];
                                            var newRow   = tableRef.insertRow(tableRef.rows.length);
                                            var newCell  = newRow.insertCell(0);
                                            var newCell2  = newRow.insertCell(1);
                                            var newCell3  = newRow.insertCell(2);
                                            var newCell4  = newRow.insertCell(3);
                                            var style = "width:150px;border:0;outline:0;display:inline-block"
                                            var value = "...";
                                            //<input name='col1[]' style='border:0;outline:0;display:inline-block' value='value'>
                                            var inputComprimento = document.createElement("input");
                                            inputComprimento.name += "line"+(tableRef.rows.length-1)+"[]";
                                            inputComprimento.style += style;
                                            inputComprimento.value += value;
                                            newCell.appendChild(inputComprimento);
                                            var inputLargura = document.createElement("input");
                                            inputLargura.name += "line"+(tableRef.rows.length-1)+"[]";
                                            inputLargura.style += style;
                                            inputLargura.value += value;
                                            newCell2.appendChild(inputLargura);
                                            var inputAltura = document.createElement("input");
                                            inputAltura.name += "line"+(tableRef.rows.length-1)+"[]";
                                            inputAltura.style += style;
                                            inputAltura.value += value;
                                            newCell3.appendChild(inputAltura);
                                            var iconeExcluir = document.createElement("i");
                                            iconeExcluir.className = "nc-icon nc-simple-remove";
                                            iconeExcluir.id = tableRef.rows.length;
                                            iconeExcluir.onclick = removeLine;
                                            newCell4.appendChild(iconeExcluir);
                                            var tableRef = document.getElementById('tamanhoTabela').value=tableRef.rows.length;
                                        }
                                        function removeLine(){
                                            var tableRef = document.getElementById('tabela').getElementsByTagName('tbody')[0];
                                            document.getElementById("tabela").deleteRow(this.id);
                                            var tableRef = document.getElementById('tamanhoTabela').value=tableRef.rows.length;
                                        }
                                        </script>
                                        <input id="tamanhoTabela" value="<?=$tamanho_lista?>" type="hidden" name="tamanho_tabela"/>        
                                
                               
                                <table class="table" id="tabela">
                                    <thead>
                                        <tr>
                                        <th scope="col">Comprimento (m)</th>
                                        <th scope="col">Largura (cm)</th>
                                        <th scope="col">Altura (cm)</th>
                                        <th>
                                            <i class="nc-icon nc-simple-add" onclick="addLine()"></i>
                                        </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $indice = 0;
                                            if($resultadoLigacao !== null){
                                                while ($rowl = pg_fetch_row($resultadoLigacao)) {
                                                    $line = "line".$indice."[]";
                                                    echo "<tr>";
                                                    echo "<td><input name='$line' style='width:150px;border:0;outline:0;display:inline-block' value='$rowl[1]'/> </td>";
                                                    echo "<td><input name='$line' style='width:150px;border:0;outline:0;display:inline-block' value='$rowl[2]'/></td>";
                                                    echo "<td><input name='$line' style='width:150px;border:0;outline:0;display:inline-block' value='$rowl[3]'/></td>";
                                                    echo "<td style='border-bottom-width: 0px;'><i class='nc-icon nc-simple-remove' id='$indice' onclick='removeLine()'></i></td>";
                                                    echo "</tr>";
                                                    $indice = $indice+1;
                                                }
                                            }
                                        ?>
                                    </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                </div>
                                <div class="card-body all-icons">
                                    <div class="col-md-12">
                                        <label for="exampleFormControlTextarea1">Descrição</label>
                                        <script type="text/javascript">
                                            bkLib.onDomLoaded(function() { nicEditors.allTextAreas() }); // convert all text areas to rich text editor on that page

                                            bkLib.onDomLoaded(function() {
                                                new nicEditor().panelInstance('area1');
                                            }); // convert text area with id area1 to rich text editor.

                                            bkLib.onDomLoaded(function() {
                                                new nicEditor({fullPanel : true}).panelInstance('area2');
                                            }); // convert text area with id area2 to rich text editor with full panel.
                                        </script>
                                        <script type="text/javascript">
                                            //<![CDATA[
                                            bkLib.onDomLoaded(function() {
                                                    new nicEditor({maxHeight : 200}).panelInstance('descricao');
                                                    new nicEditor({fullPanel : true,maxHeight : 200}).panelInstance('area1');
                                            });
                                            //]]>
                                        </script>
                                        <textarea name="descricao" id="descricao" style="width:70%;height:200px;">
                                         <?php echo htmlspecialchars($row[2]); ?>
                                        </textarea>

                                    <script>
                                        function excluir(id){
                                            window.location.href = "produto_controller.php?acao=excluir&id="+id;
                                        }
                                    </script>

                                    <div class="col-md-12" style="margin-top: 15px;">
                                        <?php 
                                            if($row[0] == null){
                                                echo "<button type='submit' class='btn btn-success' style='float:right'>Salvar</button>";
                                            }else{
                                                echo "<button type='submit' class='btn btn-success' style='float:right'>Alterar</button>";
                                                echo "<button type='button' class='btn btn-danger' style='float:right;margin-right: 15px;' onclick='excluir($row[0])'>Excluir</button>";
                                            }
                                        ?>
                                    </div>
                                    <a type="button" class='btn btn-light' style="float:right;margin-right: 15px;"
                                            href="produtos.php">Voltar</a>
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
