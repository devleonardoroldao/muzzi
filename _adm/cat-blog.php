<?php include_once "inc/header.php";?>
<title>Cadastrar Categoria Blog</title>
<style>.titulo {text-transform:uppercase; font-size:11px; font-family:inter; padding-top:7px}</style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
<?php include_once "inc/navbar_topo.php";?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
<?php include_once "inc/sidebar_menu.php";?>
</aside>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
<div class="container-fluid">
<div class="col-sm-6">
<h1 style="font-family:inter; text-transform:uppercase">Cadastrar Categoria Blog</h1>
</div>

</div><!-- /.container-fluid -->
</section>

<?php 

if(isset($_POST['acao']) && $_POST['acao'] == 'cadastrar'){
include_once "inc/slug.php";
$categoria = filter_input(INPUT_POST, 'categoria');
$slug = slug($categoria);


if($categoria == ''){
echo "<div class='alert alert-danger' role='alert'>Campos obrigatórios</div>";
}else{
if($painel->Cadcat_blog($categoria, $slug)){
echo "<div class='alert'><img src='images/load.gif' width='50'> Adicionando...</div>";
echo "<meta http-equiv=refresh content='0;URL='>";
}else{
echo "<div class='alert alert-danger' role='alert'>Erro ao cadastrar, veririque a conexão com a internet.</div>";
}
}	
}

?>

<!-- Main content -->
<section class="content">
<!-- Default box -->
<div class="card">

<div class="card-body p-0">
<table class="table table-striped projects" style="font-size:13px">
                            <thead>
                                <tr style="font-family:inter">
                                    <th style="width:20%">COD</th>
                                    <th style="width:70%">Categoria</th>
                            
                                    <th style="width:10%">REMOVER</th>
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
                                $sql = BD::conn()->prepare(" SELECT * FROM cat_blog ORDER by categoria ASC");
                                $sql->execute();
                                if ($sql->rowCount() == 0) {
                                    echo "<div class='alert alert-warning' role='alert' style='font-family:inter; border:0; border-radius:0; width:100%;'>Não há registros.</div>";
                                } else {
                                ?>
                                    <tr>
                                        <?php while ($row = $sql->fetchObject()) { ?>
                                            <td>
                                            <?php echo $row->id_blog; ?>
                                            <td>

                                                <?php echo $row->categoria; ?>

                                            </td>
                                          

                                            <td><a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#desativar<?php echo $row->id_blog; ?>"><i class="fas fa-ban"></i></a></td>

                                    </tr>

                                    <!-- excluir -->
                                    <div class="modal fade" id="desativar<?php echo $row->id_blog; ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" style="font-family:inter; font-size:13px; font-weight:bold; text-transform:uppercase">
                                                    EXCLUIR?<br/><br/> <?php echo $row->categoria;?> </h4>
                                                </div>
                                                <form action="remove-cat-blog.php" method="post">
                                                    <div class="modal-footer justify-content-between" style="background:#f1f1f1">
                                                        <button class="btn btn-success" data-dismiss="modal">Não</button>

                                                        <button type="submit" name="excluir" class="btn btn-primary"><i class="fa fa-check"></i> Sim</button>
                                                        <input name="id_blog" value="<?php echo $row->id_blog; ?>" type="hidden">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                  
                    <!-- end excluir -->
            <?php }} ?>




               



                </tbody>
                </table>
                                        </div>


<div class="card-header">



<form action="" method="post">

<div class="row">

<div class="col-6">
<label class="titulo">Categoria*</label>
<input type="text" name="categoria" maxlength="65" class="form-control form-control" placeholder="Categoria" required>
</div>

</div>

<br/>
<div class="card-footer">
<input type="hidden" name="acao" value="cadastrar" />

<!--<input type="hidden" name="idcurso" value="<?php //echo(random_int(10,10000));?>" />-->
<button type="submit" class="btn btn-primary" style="float:right"><i class="fa fa-check"></i> Cadastrar</button>
</div>
</div>
<!-- /.col-->
</div>

</div>
</div>
</div>

</form>






</div>

</div>
</section>










</div>
<footer class="main-footer">
</body>
<?php include_once "inc/footer.php";?>