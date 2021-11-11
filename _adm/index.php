<?php 
session_start();
require_once("classes/BD.class.php");
require_once("classes/LoginPainel.class.php"); 
$log = new LoginPainel; 
?>
<!DOCTYPE html>
<html lang="pt-br" >
<head>
  <meta charset="UTF-8">
  <meta name="robots" content="noindex, nofollow">
<meta name="googlebot" content="noindex, follow">
  <title>Restrito</title>
  <link rel="stylesheet" href="css/style.css">

</head>
<body>
<!-- partial:index.partial.html -->
<div class="page">
  <div class="container">
    <div class="left">
      <div class="login">Admin</div>
      <div class="eula">Área do Administrador</div>
    </div>
    <div class="right">
      <svg viewBox="0 0 320 300">
        <defs>
          <linearGradient
                          inkscape:collect="always"
                          id="linearGradient"
                          x1="13"
                          y1="193.49992"
                          x2="307"
                          y2="193.49992"
                          gradientUnits="userSpaceOnUse">
            <stop
                  style="stop-color:#ff00ff;"
                  offset="0"
                  id="stop876" />
            <stop
                  style="stop-color:#ff0000;"
                  offset="1"
                  id="stop878" />
          </linearGradient>
        </defs>
        <path d="m 40,120.00016 239.99984,-3.2e-4 c 0,0 24.99263,0.79932 25.00016,35.00016 0.008,34.20084 -25.00016,35 -25.00016,35 h -239.99984 c 0,-0.0205 -25,4.01348 -25,38.5 0,34.48652 25,38.5 25,38.5 h 215 c 0,0 20,-0.99604 20,-25 0,-24.00396 -20,-25 -20,-25 h -190 c 0,0 -20,1.71033 -20,25 0,24.00396 20,25 20,25 h 168.57143" />
      </svg>
	  <style>
	  .campos {background:#f1f1f1; color:#000}
	  .entrar {cursor:pointer}
	  
	  </style>
	<?php 
	if(isset($_POST['acao']) && $_POST['acao'] == 'entrar'){
	$email = strip_tags(filter_input(INPUT_POST, 'email'));
	$senha = strip_tags(filter_input(INPUT_POST, 'senha'));	
	if($email == '' || $senha == ''){
	echo '<script>alert("Restrito ao administrador");location.href="./"</script>';
	}else{
	if($log->logar($email, $senha)){
	$atualizarLog = BD::conn()->prepare("UPDATE usuarios SET lastlog = NOW() WHERE  email = '$email' AND status = 1 ");
	$atualizarLog->execute();
	
	echo '<script>location.href="painel.php"</script>';
	
	}else{
	echo '<script>alert("E-mail ou senha incorreto!");location.href="./"</script>';

	}
	}
	}
?>
      <div class="form">
	    <form action="" method="post">
        <label for="email">E-MAIL*</label>
        <input type="email" name="email" id="email" maxlength="75" class="campos" onKeypress="if(event.keyCode==32)event.returnValue=false" autocomplete="off" required >
        <label for="password">SENHA*</label>
        <input type="password" name="senha" id="password" maxlength="10" class="campos" onKeypress="if(event.keyCode==32)event.returnValue=false" autocomplete="off" required >
		<input type="hidden" name="acao" value="entrar" />
        <input type="submit" id="submit" value="Entrar" class="entrar" >
		</form>
      </div>
    </div>
  </div>
</div>
<!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/animejs/2.2.0/anime.min.js'></script>
  <script src="js/script.js"></script>

</body>
</html>
