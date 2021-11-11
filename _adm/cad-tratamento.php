<?php include_once "inc/header.php"; ?>
<title>Cadastrar Serviços</title>
<style>
    .titulo {
        text-transform: uppercase;
        font-size: 11px;
        font-family: inter;
        padding-top: 7px
    }
</style>
</head>

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

                    <?php

                    if (isset($_POST['acao']) && $_POST['acao'] == 'cadastrar') {
                        include_once "inc/slug.php";
                        $categoria_prod = $_POST['categoria_prod'];
                        $titulo = $_POST['titulo'];
                        $slug = slug($titulo);
                        $descricao_curta = $_POST['descricao_curta'];
                        $desconto = $_POST['desconto'];
                        $descricao = $_POST['descricao'];
                        $files = $_FILES['imagem'];

                        if ($files == '') {
                            echo "<div class='alert alert-danger' role='alert'>Imagem obrigatória</div>";
                        } elseif ($files['error'] == '4') {
                            echo "<div class='alert alert-danger' role='alert'>Imagem inválida, permitidas: jpg, jpeg</div>";
                        } else {
                            if ($painel->CadTratamento($categoria_prod, $titulo, $slug, $descricao_curta, $desconto, $descricao, $files['tmp_name'], $files['name'])) {
                                echo "<div class='alert alert-default' role='alert'><img src='images/load.gif'></div>";
                                echo "<meta http-equiv=refresh content='0;URL='>";
                            } else {
                                echo "<div class='alert alert-danger' role='alert'>Erro ao cadastrar, veririque a conexão com a internet.</div>";
                            }
                        }
                    }
                    ?>

                    <div class="col-sm-6">

                        <h1 style="font-family:inter">Cadastrar Serviços</h1>

                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <!-- Default box -->
                <div class="card">

                    <div class="card-header">


                        <div class="card-tools">

                            <button type="button" data-toggle="modal" data-target="#modal-lg" class="btn btn-success btn-sm">
                                <i class="fas fa-edit"></i>
                            </button>


                            <button onclick="location.href='painel.php'" type="button" class="btn btn-default btn-sm">
                                <i class="fas fa-home"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>






                        </div>
                    </div>


                    <div class="card-body p-0">
                        <table class="table table-striped projects" style="font-size:13px">
                            <thead>
                                <tr style="font-family:inter">
                                    <th style="width:20%">FOTO</th>
                                    <th style="width:40%">Serviço</th>
                                    <th style="width:30%">CATEGORIA</th>
                                    <th style="width:5%"></th>
                                    <th style="width:5%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <style>
                                    .Foto {
                                        width: 80px;
                                        height: 70px;
                                        object-fit: cover
                                    }
                                </style>
                                <?php
                                $sql = BD::conn()->prepare(" SELECT * FROM tpl_produtos ORDER by id_produto DESC");
                                $sql->execute();
                                if ($sql->rowCount() == 0) {
                                    echo "<div class='alert alert-warning' role='alert' style='font-family:inter; border:0; border-radius:0; width:100%;'>Não há registros.</div>";
                                } else {
                                ?>
                                    <tr>
                                        <?php while ($row = $sql->fetchObject()) { ?>
                                            <td><img class="Foto" src="../assets/img_produto/<?php echo $row->img; ?>"></td>

                                            <td>

                                                <?php echo $row->titulo; ?>

                                            </td>

                                            <td>

                                                <?php echo $row->categoria_prod; ?>

                                            </td>
                                            <td><a class="btn btn-success btn-sm" href="edit-tratamento.php?id_produto=<?php echo $row->id_produto; ?>"><i class="fas fa-edit"></i></a></td>
                                            <td><a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#desativar<?php echo $row->id_produto; ?>"><i class="fas fa-ban"></i></a></td>

                                    </tr>

                                    <!-- excluir -->
                                    <div class="modal fade" id="desativar<?php echo $row->id_produto; ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" style="font-family:inter; font-size:13px; font-weight:bold; text-transform:uppercase">
                                                    EXCLUIR?<br/><br/> <?php echo $row->titulo;?> </h4>
                                                </div>
                                                <form action="remove-tratamento.php" method="post">
                                                    <div class="modal-footer justify-content-between" style="background:#f1f1f1">
                                                        <button class="btn btn-success" data-dismiss="modal">Não</button>

                                                        <button type="submit" name="excluir" class="btn btn-primary"><i class="fa fa-check"></i> Sim</button>
                                                        <input name="id_produto" value="<?php echo $row->id_produto; ?>" type="hidden">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                    </div>
                    <!-- end excluir -->
            <?php }
                                    } ?>




                </div>



                </tbody>
                </table>



        </div>
    </div>
    </section>
    </div>
    <footer class="main-footer">
</body>
<!-- cadastrar -->

<div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div class="card card-warning">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fa fa-info-circle"></i> Cadastrar</h3>
                    </div>
                    <div class="card-body">

                        <form action="" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="acao" value="cadastrar">
                            <div class="row">

                                <div class="col-4">
                                    <label class="titulo">SELECIONE UMA CATEGORIA</label>
<select name="categoria_prod" class="form-control form-control" style="height:45px" required>
                                
<?php 

$sq = BD::conn()->prepare ("SELECT * FROM cat_tratamento order by categoria ASC ");
 $sq->execute();
 if($sq->rowCount() == ''){
 echo "<option value=''> -- Adicione uma Categoria -- </option>";
 }else{	
 while($result = $sq->fetchObject()){
?>
<option value="<?php echo $result->id_tratamento;?>"><?php echo $result->categoria;?></option>                               
<?php }}?>





                                    </select>
                                </div>

                                <div class="col-8">
                                    <label class="titulo">ENVIE UMA IMAGEM jpg, jpeg:</label>
                                    <input type="file" name="imagem" accept="image/jpeg,jpg" class="form-control form-control" style="height:45px; cursor:pointer" required />



                                </div>



                            </div>

                            <div class="row">

                                <div class="col-4">
                                    <label class="titulo">NOME DO TRATAMENTO</label>
                                    <input name="titulo" class="form-control form-control" required />

                                </div>

                                <div class="col-8">
                                    <label class="titulo">Destaque</label>
                                    <input type="text" name="descricao_curta" class="form-control form-control" required />



                                </div>



                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <label class="titulo">DESCONTO</label>
                                    <input name="desconto" class="form-control form-control" required />
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <label class="titulo">DESCREVA</label>
                                    <textarea id='summernote' name='descricao'></textarea>
                                </div>
                            </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between" style="background:#f1f1f1">

                <button type="button" class="btn btn-default" data-dismiss="modal"> Fechar</button>
                <button type="submit" class="btn btn-success"> Cadastrar</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- end cadastrar -->
<?php include_once "inc/footer.php"; ?>