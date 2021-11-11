<?php
require_once("classes/BD.class.php");
if(isset($_POST['excluir'])):
$id = $_POST['id_blog'];

$st = BD::conn()->prepare("SELECT id_blog FROM cat_blog WHERE id_blog = ".$id." ");
$st->execute(array($id));

$sql = "DELETE FROM cat_blog WHERE id_blog = :id";
$stm = BD::conn()->prepare($sql);
$stm->bindValue(':id', $id);
$retorno = $stm->execute();
if ($retorno):
echo "";
else:
echo "<div class='alert alert-danger' role='alert'>Erro ao excluir!</div> ";
endif;
header('Location: ' . $_SERVER['HTTP_REFERER']);
endif;
?>
