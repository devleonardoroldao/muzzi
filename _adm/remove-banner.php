<?php
require_once("classes/BD.class.php");
if(isset($_POST['excluir'])):
$id = $_POST['id'];

$st = BD::conn()->prepare("SELECT foto FROM banners WHERE id = ".$id." ");
$st->execute(array($id));
$fetchFoto = $st->fetchObject();
			
unlink('../assets/img_banner/'.$fetchFoto->foto);

$sql = "DELETE FROM banners WHERE id = :id";
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
