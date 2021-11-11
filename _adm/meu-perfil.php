<?php include_once "inc/header.php";?>
<title>Meu Perfil</title>
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
	<br/>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">



          <div class="col-md-12">
		  
		  
		  <?php 
if(isset($_POST['acao']) && $_POST['acao'] == 'cadastrarRedes'){	

$telefone = strip_tags(filter_input(INPUT_POST, 'telefone'));
$whatsapp = filter_input(INPUT_POST, 'whatsapp');
$email = strip_tags(filter_input(INPUT_POST, 'email'));	
$facebook = strip_tags(filter_input(INPUT_POST, 'facebook'));	
$instagram = strip_tags(filter_input(INPUT_POST, 'instagram'));	
$twitter = strip_tags(filter_input(INPUT_POST, 'twitter'));	

if($email == '' || $whatsapp ==''){
echo "<div class='alert alert-danger' role='alert'>E-mail e whatsapp obrigatório.</div>";
}
else{
try {	
$id = (int)7;
$editar = BD::conn()->prepare("UPDATE tb_redes SET telefone = :telefone, whatsapp = :whatsapp, email = :email, facebook = :facebook, instagram = :instagram, twitter = :twitter  WHERE id = :id");			
$editar->execute(array(':id' => $id,':telefone' => $telefone,':whatsapp' => $whatsapp,':email' => $email, ':facebook' => $facebook,':instagram' =>$instagram, ':twitter'=>$twitter )); 	
echo "<div class='alert alert-default' role='alert'>Atualizado <img src='images/load.gif'></div>";
echo "<meta http-equiv=refresh content='0;URL='>";
}
catch(PDOException $e) {
echo 'Error: ' . $e->getMessage();
exit();
}
}
}

?>
		  
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills" style="font-family:inter">
          
           
                  <li class="nav-item"><a class="nav-link active"  href="#settings" data-toggle="tab"><i class="fa fa-user"></i> Meu Perfil</a></li>
				  <li class="nav-item"><a class="nav-link" href="#login" data-toggle="tab"><i class="fa fa-key"></i> Login</a></li>
				  
				  <li class="nav-item"><a class="nav-link" href="#redes" data-toggle="tab"><i class="fa fa-users"></i> Redes</a></li>
				  
				  
                </ul>
              </div><!-- /.card-header -->
              
			  
			  
			  
			  <div class="card-body">
                <div class="tab-content">
                 
				
<?php
 $sql = BD::conn()->prepare ("SELECT * FROM usuarios WHERE email = '$usuarioLogado->email' ");
 $sql->execute();
 if($sql->rowCount() == 0){
 echo "<br/>Não existe administrador.";
 }else{	
 while($resultado = $sql->fetchObject()){
 ?>
                  <div class="active tab-pane" id="settings">
                    <form class="form-horizontal" style="font-family:inter; font-size:13px">
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Nome</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control form-control-lg" id="inputName" placeholder="<?php echo $usuarioLogado->nomealuno;?>" disabled>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">E-mail</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control form-control-lg" id="inputEmail" placeholder="<?php echo $usuarioLogado->email;?>" disabled>
                        </div>
                      </div>
               
                  
                      <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">Senha</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control form-control-lg" id="inputSkills" placeholder="....." disabled>
                        </div>
                      </div>
					  
					   <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">Nível</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control form-control-lg" id="inputSkills" placeholder="<?php
						  if ($usuarioLogado->status == "1"){
						  echo "administrador";
						  }if ($usuarioLogado->status == "2"){
						  echo "gerência"; 
						  }if ($usuarioLogado->status == "3"){
						  echo "vendedor"; 
						  }
						  ?>" disabled>
                        </div>
                      </div>
					  
					  
					    <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">Último login</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control form-control-lg" id="inputSkills" placeholder="<?php echo $usuarioLogado->lastlog;?>" disabled>
                        </div>
                      </div>
					  
					
                
             
                    </form>
                  </div>
				  
				  <?php }}?>
				  
				  
				       <div class="tab-pane" id="login">
					   
					   <?php 
if(isset($_POST['acao']) && $_POST['acao'] == 'cadastrar'){	
$nome = strip_tags(filter_input(INPUT_POST, 'nome'));
$email = filter_input(INPUT_POST, 'email');
$senha = strip_tags(filter_input(INPUT_POST, 'senha'));	
$status = strip_tags(filter_input(INPUT_POST, 'status'));	
$lastlog = strip_tags(filter_input(INPUT_POST, 'lastlog'));	

if($email == '' || $senha ==''){
echo "<div class='alert alert-danger' role='alert'>E-mail e senha obrigatório.</div>";
}
else{
try {	
$id = (int)1;
$editar = BD::conn()->prepare("UPDATE usuarios SET nomealuno = :nome, email = :email, senha = :senha, status = :status, lastlog = :lastlog  WHERE id = :id");			
$editar->execute(array(':id' => $id,':nome' => $nome,':email' => $email,':senha' => $senha, ':status' => $status,':lastlog' =>$lastlog )); 	
echo "<div class='alert alert-success' role='alert'><b>Validado</b> <img src='img/load.gif'></div>";
echo "<meta http-equiv=refresh content='0;URL=?acao=sair'>";
}
catch(PDOException $e) {
echo 'Error: ' . $e->getMessage();
exit();
}
}
}

?>

<?php
 $sql = BD::conn()->prepare ("SELECT * FROM usuarios WHERE email = '$usuarioLogado->email' ");
 $sql->execute();
 if($sql->rowCount() == 0){
 echo "<br/>Não existe validação.";
 }else{	
 while($resultado = $sql->fetchObject()){
 ?>
<form action="" method="post" class="form-horizontal" style="font-family:inter; font-size:13px">
               
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">E-mail*</label>
                        <div class="col-sm-10">
                          <input type="email" value="<?php echo $usuarioLogado->email;?>" class="form-control form-control-lg" id="inputEmail" placeholder="<?php echo $usuarioLogado->email;?>" onKeypress="if(event.keyCode==32)event.returnValue=false" name="email" required >
                        </div>
                      </div>
					  
					         <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Senha*</label>
                        <div class="col-sm-10">
                          <input type="password" value="<?php echo $usuarioLogado->senha;?>" class="form-control form-control-lg" id="inputName" placeholder="<?php echo $usuarioLogado->senha;?>" maxlength="10" autocomplete="off" onKeypress="if(event.keyCode==32)event.returnValue=false" name="senha" required >
                        </div>
                      </div>
					  
                  
                
                
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
	<input type="hidden" name="nome" value="<?php echo $usuarioLogado->nomealuno;?>" />
	<input type="hidden" name="lastlog" value="<?php echo $usuarioLogado->lastlog;?>" />
	
	
	
	<input type="hidden" name="status" value="<?php echo $usuarioLogado->status;?>" />
<input type="hidden" name="acao" value="cadastrar" />
                          <button type="submit" class="btn btn-success">Editar login <i class="fa fa-angle-right"></i></button>
                        </div>
                      </div>
                    </form>
                  </div>
				  
				  <?php }}?>
				  
				  
				  
				  
				  
				  	       <div class="tab-pane" id="redes">
					   


<?php
 $sql = BD::conn()->prepare ("SELECT * FROM tb_redes WHERE id=7 ");
 $sql->execute();
 if($sql->rowCount() == 0){
 echo "<br/>Não existe validação.";
 }else{	
 while($resultado = $sql->fetchObject()){
 ?>
<form action="" method="post" class="form-horizontal" style="font-family:inter; font-size:13px">
               
			     <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Telefone</label>
                        <div class="col-sm-10">
                          <input type="text" value="<?php echo $resultado->telefone;?>" class="form-control form-control-lg" id="inputName" placeholder="<?php echo $resultado->telefone;?>" maxlength="20" autocomplete="off" name="telefone">
                        </div>
                      </div>
					  
					  
					   <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Whatsapp</label>
                        <div class="col-sm-10">
                          <input type="text" value="<?php echo $resultado->whatsapp;?>" class="form-control form-control-lg" id="inputName" placeholder="<?php echo $resultado->whatsapp;?>" maxlength="70" autocomplete="off" name="whatsapp" required >
                        </div>
                      </div>
					  
			   
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">E-mail</label>
                        <div class="col-sm-10">
                          <input type="email" value="<?php echo $resultado->email;?>" class="form-control form-control-lg" id="inputEmail" placeholder="<?php echo $resultado->email;?>" onKeypress="if(event.keyCode==32)event.returnValue=false" name="email" maxlength="75" required >
                        </div>
                      </div>
					  
					       
					  
					       <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Facebook</label>
                        <div class="col-sm-10">
                          <input type="text" value="<?php echo $resultado->facebook;?>" class="form-control form-control-lg" id="inputName" placeholder="<?php echo $resultado->facebook;?>" maxlength="100" autocomplete="off" name="facebook" >
                        </div>
                      </div>
					  
                  
				  					       <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Instagram</label>
                        <div class="col-sm-10">
                          <input type="text" value="<?php echo $resultado->instagram;?>" class="form-control form-control-lg" id="inputName" placeholder="<?php echo $resultado->instagram;?>" maxlength="100" autocomplete="off" name="instagram" >
                        </div>
                      </div>
				  
				  
				   <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Twitter</label>
                        <div class="col-sm-10">
                          <input type="text" value="<?php echo $resultado->twitter;?>" class="form-control form-control-lg" id="inputName" placeholder="<?php echo $resultado->twitter;?>" maxlength="100" autocomplete="off" name="twitter"  >
                        </div>
                      </div>
				  
                
                
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">

<input type="hidden" name="acao" value="cadastrarRedes" />
                          <button type="submit" class="btn btn-success">Atualizar <i class="fa fa-angle-right"></i></button>
                        </div>
                      </div>
                    </form>
                  </div>
				  
				  <?php }}?>
				  
				  
				  
				  
				  
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
   

</body>
<?php include_once "inc/footer.php";?>