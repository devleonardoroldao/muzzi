<?php
require_once("classes/BD.class.php");
if(isset($_POST['excluir'])):
$id = $_POST['id'];

$st = BD::conn()->prepare("SELECT foto FROM galeria WHERE id_galeria = ".$id." ");
$st->execute(array($id));
$fetchFoto = $st->fetchObject();
			
unlink('../assets/img_galeria/'.$fetchFoto->foto);

$sql = "DELETE FROM galeria WHERE id_galeria = :id";
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
