<?php
require_once("classes/BD.class.php");
if(isset($_POST['excluir'])):
$id = $_POST['id_produto'];

$st = BD::conn()->prepare("SELECT img FROM tpl_produtos WHERE id_produto = ".$id." ");
$st->execute(array($id));
$fetchFoto = $st->fetchObject();
			
unlink('../assets/img_produto/'.$fetchFoto->img);

$sql = "DELETE FROM tpl_produtos WHERE id_produto = :id";
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
