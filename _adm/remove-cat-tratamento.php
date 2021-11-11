<?php
require_once("classes/BD.class.php");
if(isset($_POST['excluir'])):
$id = $_POST['id_tratamento'];

$st = BD::conn()->prepare("SELECT id_tratamento FROM cat_tratamento WHERE id_tratamento = ".$id." ");
$st->execute(array($id));

$sql = "DELETE FROM cat_tratamento WHERE id_tratamento = :id";
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
