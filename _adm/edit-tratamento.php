<?php
include_once "inc/header.php";
$id = (int)$_GET['id_produto'];
?>

<title>Editar Post</title>
<style>
    .titulo {
        text-transform: uppercase;
        font-size: 11px;
        font-family: inter;
        padding-top: 7px
    }
</style>
</head>
<style>
.loader{
    position: absolute;
    top:0px;
    right:0px;
    width:100%;
    height:100%;
    background-color:#000;
    background-image:url('ajax-loader.gif');
    background-size: 50px;
    background-repeat:no-repeat;
    background-position:center;
    z-index:99999 !important ;
    opacity: 0.8;
    filter: alpha(opacity=40);
}
/* Absolute Center Spinner */
.loading {
  position: fixed;
  z-index: 99999 !important;
  height: 5em;
  width: 5em;
  overflow: visible;
  margin: auto;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
}

/* Transparent Overlay */
.loading:before {
  content: '';
  display: block;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(255,255,255,0.4);
}

/* :not(:required) hides these rules from IE9 and below */
.loading:not(:required) {
  /* hide "loading..." text */
  font: 0/0 a;
  color: transparent;
  text-shadow: none;
  background-color: transparent;
  border: 0;
}

.loading:not(:required):after {
  content: '';
  display: block;
  font-size: 10px;
  width: 1em;
  height: 1em;
  margin-top: -0.5em;
  -webkit-animation: spinner 1500ms infinite linear;
  -moz-animation: spinner 1500ms infinite linear;
  -ms-animation: spinner 1500ms infinite linear;
  -o-animation: spinner 1500ms infinite linear;
  animation: spinner 1500ms infinite linear;
  border-radius: 0.5em;
  -webkit-box-shadow: rgba(0, 0, 0, 0.75) 1.5em 0 0 0, rgba(0, 0, 0, 0.75) 1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) 0 1.5em 0 0, rgba(0, 0, 0, 0.75) -1.1em 1.1em 0 0, rgba(0, 0, 0, 0.5) -1.5em 0 0 0, rgba(0, 0, 0, 0.5) -1.1em -1.1em 0 0, rgba(0, 0, 0, 0.75) 0 -1.5em 0 0, rgba(0, 0, 0, 0.75) 1.1em -1.1em 0 0;
  box-shadow: rgba(0, 0, 0, 0.75) 1.5em 0 0 0, rgba(0, 0, 0, 0.75) 1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) 0 1.5em 0 0, rgba(0, 0, 0, 0.75) -1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) -1.5em 0 0 0, rgba(0, 0, 0, 0.75) -1.1em -1.1em 0 0, rgba(0, 0, 0, 0.75) 0 -1.5em 0 0, rgba(0, 0, 0, 0.75) 1.1em -1.1em 0 0;
}

/* Animation */

@-webkit-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@-moz-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@-o-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
</style>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <?php include_once "inc/navbar_topo.php"; ?>
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <?php include_once "inc/sidebar_menu.php"; ?>
        </aside>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="col-sm-6">
                        <h1 style="font-family:inter; text-transform:uppercase">Editar Tratamento</h1>
                    </div>

                </div><!-- /.container-fluid -->
            </section>

            <?php

            if (isset($_POST['acao']) && $_POST['acao'] == 'cadastrar') {
               include_once "inc/slug.php";
              $categoria_prod = $_POST['categoria_prod'];
              $titulo = $_POST['titulo'];
              $slug = slug($titulo);
              $descricao_curta = $_POST['descricao_curta'];
              $desconto = $_POST['desconto'];
              $descricao = $_POST['descricao'];

               
                if($titulo == ''){
                    echo "<div class='alert alert-danger' role='alert'>Nome do Tratamento obrigatório.</div>";
                    }else{
                    try {	
                    
                    
                    $editar = BD::conn()->prepare("UPDATE tpl_produtos SET 
                    categoria_prod= :categoria_prod,
                    titulo= :titulo, 
                    slug= :slug,
                    descricao_curta= :descricao_curta, 
                    desconto= :desconto, 
                    descricao= :descricao
                    WHERE id_produto = :id");
                                
                    $editar->execute(array(
                    ':id' => $id,
                    ':categoria_prod' => $categoria_prod,
                    ':titulo' =>$titulo, 
                    ':slug' =>$slug, 
                    ':descricao_curta' =>$descricao_curta, 
                    ':desconto' =>$desconto, 
                    ':descricao'=>$descricao ));
                         
                    echo "<div class='loading'>Loading&#8230;</div>";
                    echo "<meta http-equiv=refresh content='0;URL='>";
                    }
                    catch(PDOException $e) {
                    echo 'Error: ' . $e->getMessage();
                    
                    exit();
                    }
                 }
              }

            ?>

            <!-- Main content -->
            <section class="content">
                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
<?php 

$sql = BD::conn()->prepare ("SELECT * FROM tpl_produtos WHERE id_produto = ".$id." ");
 $sql->execute();
 if($sql->rowCount() == 0){
 echo "";
 }else{	
 while($resultado = $sql->fetchObject()){

?>
                          <form action="" method="post">
                            <input type="hidden" name="acao" value="cadastrar">
                            <div class="row">

                                <div class="col-4">
                                    <label class="titulo">CATEGORIA</label>
                                    <select name="categoria_prod" class="form-control form-control" style="height:45px" required >

      
 <?php 
 $sq = BD::conn()->prepare ("SELECT c.id_tratamento, c.categoria, e.id_produto, e.categoria_prod
  FROM cat_tratamento c join tpl_produtos e ON e.categoria_prod = c.id_tratamento WHERE id_produto = ".$id." ");
 $sq->execute();
 if($sq->rowCount() == 0){
 echo "";
 }else{	
 while($result = $sq->fetchObject()){
?>

<option value="<?php echo $result->id_tratamento;?>">-- <?php echo $result->categoria;?> --</option>                               
<?php }}?>                                  



<?php 
 $sq = BD::conn()->prepare ("SELECT * FROM cat_tratamento order by categoria ASC");
 $sq->execute();
 if($sq->rowCount() == 0){
 echo "";
 }else{	
 while($result = $sq->fetchObject()){
?>

<option value="<?php echo $result->id_tratamento;?>"><?php echo $result->categoria;?></option>                               
<?php }}?>



                                    </select>
                                </div>

                                <div class="col-8">
                                    <label class="titulo">URL</label>
                                    <input type="text" value='<?php echo $resultado->slug;?>' name="slug" class="form-control form-control" style="height:45px; cursor:pointer" readonly />



                                </div>



                            </div>

                            <div class="row">

                                <div class="col-4">
                                    <label class="titulo">NOME DO TRATAMENTO</label>
                                    <input name="titulo" value='<?php echo $resultado->titulo;?>' class="form-control form-control" required />

                                </div>

                                <div class="col-8">
                                    <label class="titulo">Destaque</label>
                                    <input type="text" name="descricao_curta" value='<?php echo $resultado->descricao_curta;?>'
                                     class="form-control form-control" required />



                                </div>



                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <label class="titulo">DESCONTO</label>
                                    <input name="desconto" value='<?php echo $resultado->desconto;?>' class="form-control form-control" required />
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <label class="titulo">DESCREVA O TRATAMENTO</label>
                                    <textarea id='summernote' name='descricao'><?php echo $resultado->descricao;?></textarea>
                                </div>
                            </div>
                            <?php }}?>
                    </div>
                </div>

                <div class="modal-footer" style="background:#f1f1f1">

              
<button type="submit" class="btn btn-success"> Editar Tratamento </button>
</div>
            </div>
           
            </form>

                       

                        <br />
                        <br />

                    </div>
                </div>
        </div>

        </section>

    </div>
    <footer class="main-footer">
</body>
<?php include_once "inc/footer.php"; ?>