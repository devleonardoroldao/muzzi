<?php 
session_start();
require_once("classes/BD.class.php");
require_once("classes/LoginPainel.class.php");
$log = new LoginPainel;
if(!$log->isLogado()){
header('Location:./');
}
if(isset($_GET['acao']) ==  'sair'){
if($log->sair()){
header('Location:./');
}
}
$pegarUsuarioLogado = BD::conn()->prepare("SELECT * FROM usuarios WHERE status = '1' AND email = '".$_SESSION['downs_email']."'");
$pegarUsuarioLogado->execute();
$usuarioLogado = $pegarUsuarioLogado->fetchObject();
require_once ('classes/Painel.class.php');
$painel = new Painel;
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta name="robots" content="noindex, nofollow">
<meta name="googlebot" content="noindex, follow">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
  <link rel="stylesheet" href="plugins/codemirror/codemirror.css">
  <link rel="stylesheet" href="plugins/codemirror/theme/monokai.css">
  <link rel="stylesheet" href="plugins/simplemde/simplemde.min.css">
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
  <link rel="icon" href="images/favicon.png">
  
  