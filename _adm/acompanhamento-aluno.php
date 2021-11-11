<?php include_once "inc/header.php";?>
<title>Progresso do Aluno</title>
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
<?php
$id = $_GET['id'];
$pegar_con = BD::conn()->prepare("SELECT id, nomealuno, email FROM usuarios WHERE id = ".$id."");
$pegar_con->execute();
if($pegar_con->rowCount() == 0){
echo "";
}else{	
while($executar = $pegar_con->fetchObject()){
?>
<h1 style="font-family:inter">PROGRESSO: <?php echo $executar->nomealuno;?></h1>

</div>
</div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
<!-- Default box -->
<div class="card">

<div class="card-header">
<?php echo $executar->email;?>
<?php }}?>
<div class="card-tools">
<button onclick="location.href='gerenciar-alunos.php'" type="button" class="btn btn-info btn-sm">
<i class="fas fa-angle-left"></i>
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
<th style="width:40%">AULA</th>
<th style="width:30%">MODALIDADE</th>
<th style="width:10%">APROVAÇÃO</th>
</tr>
</thead>
<tbody>
<?php
$id = $_GET['id'];
$pegar_venda = BD::conn()->prepare("SELECT u.id, u.nomealuno, u.email, u.status, a.iduser, a.idcurso, a.aprovacao, c.idcurso, c.nome, c.idcategoria FROM usuarios u join assiste_curso a ON a.iduser = u.id join cursos c ON c.idcurso = a.idcurso WHERE u.id = '".$id."' ORDER by c.idcategoria ASC");

$pegar_venda->execute();
if ($pegar_venda->rowCount() == 0) {
echo "<div class='alert alert-warning' role='alert' style='font-family:inter; border:0; border-radius:0; width:100%;'>O aluno ainda <b>não foi aprovado</b> em nenhuma aula.</div>";
}else{	
?>
<?php while ($row = $pegar_venda->fetchObject()) { ?>
<tr style="font-family:inter">
<td><?php echo $row->nome;?></td>
<td><?php if($row->idcategoria == 10){ echo "Judô";}else{echo "Karatê";}?></td>
<td><?php 
if($row->aprovacao == 3){ echo "aguardando..";}
if($row->aprovacao == 2){ echo "reprovado";}
if($row->aprovacao == 1){ echo "aprovado";}
if($row->aprovacao == ''){ echo "";}
?></td>
</tr>

</div>

</tbody>
</table>

</div>
</div>
</section>
</div>
<footer class="main-footer">
</body>
<?php include_once "inc/footer.php";?>