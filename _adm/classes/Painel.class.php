    <?php class Painel extends BD{

	public function slug($string){
	$a = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]/?;:.,\\\'<>';
	$b = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr                              ';
	$string = utf8_decode($string);
	$string = strtr($string, utf8_decode($a), $b);
	$string = strip_tags(trim($string));
	$string = str_replace(" ","-",$string);
	return strtolower(utf8_encode($string));
	}
	
	public function CadTratamento($categoria_prod, $titulo, $slug, $descricao_curta, $desconto, $descricao, $tmp, $file){
		$name = md5(uniqid(rand(), true)).$file;
		require ('inc/caracteres-especiais.php');
		$pasta = '../assets/img_produto';
		$largura_max = 800;
		$altura_max	= 800;
		require ('inc/resize.php');
		$result = upload($tmp, $name, $largura_max, $altura_max, $pasta);		
		if($result != ""){
		try{
		$cadastrar = self::conn()->prepare("INSERT INTO tpl_produtos (categoria_prod, titulo, slug, descricao_curta,
		desconto, descricao, img) VALUES(:categoria_prod, :titulo, :slug, :descricao_curta,
		:desconto, :descricao, :img)");	
		
		$cadastrar->bindValue(':categoria_prod', $categoria_prod, PDO::PARAM_STR);		
		$cadastrar->bindValue(':titulo', $titulo, PDO::PARAM_STR);
		$cadastrar->bindValue(':slug', $slug, PDO::PARAM_STR);
		$cadastrar->bindValue(':descricao_curta', $descricao_curta, PDO::PARAM_STR);
		$cadastrar->bindValue(':desconto', $desconto, PDO::PARAM_STR);
		$cadastrar->bindValue(':descricao', $descricao, PDO::PARAM_STR);
		$cadastrar->bindValue(':img', $name, PDO::PARAM_STR);		
		
		if($cadastrar->execute()){
		return true;
		}else{
		return false;
		}
		}catch(PDOException $err){
		return false;
		logErrors($err);	
		}
		}else{
		return false;
		}
		}

		public function CadBlog($categoria_prod, $titulo, $slug, $descricao_curta, $desconto, $descricao, $tmp, $file){
			$name = md5(uniqid(rand(), true)).$file;
			require ('inc/caracteres-especiais.php');
			$pasta = '../assets/img_blog';
			$largura_max = 640;
			$altura_max	= 480;
			require ('inc/resize.php');
			$result = upload($tmp, $name, $largura_max, $altura_max, $pasta);		
			if($result != ""){
			try{
			$cadastrar = self::conn()->prepare("INSERT INTO blog (categoria_prod, titulo, slug, descricao_curta,
			desconto, descricao, img) VALUES(:categoria_prod, :titulo, :slug, :descricao_curta,
			:desconto, :descricao, :img)");	
			
			$cadastrar->bindValue(':categoria_prod', $categoria_prod, PDO::PARAM_STR);		
			$cadastrar->bindValue(':titulo', $titulo, PDO::PARAM_STR);
			$cadastrar->bindValue(':slug', $slug, PDO::PARAM_STR);
			$cadastrar->bindValue(':descricao_curta', $descricao_curta, PDO::PARAM_STR);
			$cadastrar->bindValue(':desconto', $desconto, PDO::PARAM_STR);
			$cadastrar->bindValue(':descricao', $descricao, PDO::PARAM_STR);
			$cadastrar->bindValue(':img', $name, PDO::PARAM_STR);		
			
			if($cadastrar->execute()){
			return true;
			}else{
			return false;
			}
			}catch(PDOException $err){
			return false;
			logErrors($err);	
			}
			}else{
			return false;
			}
			}


	public function Cadcat_blog($categoria, $slug){		
	try{
	$cadastrar = self::conn()->prepare("INSERT INTO cat_blog (categoria, slug) VALUES(:categoria, :slug)");
    $cadastrar->bindValue(':categoria', $categoria, PDO::PARAM_STR);		
    $cadastrar->bindValue(':slug', $slug, PDO::PARAM_STR);		
   	
	
	if($cadastrar->execute()){
	return true;
	}else{
	return false;
	}
	}catch(PDOException $err){
	return false;
	logErrors($err);	
	}
	}


	public function Cadcat_tratamento($categoria, $slug){		
		try{
		$cadastrar = self::conn()->prepare("INSERT INTO cat_tratamento (categoria, slug) VALUES(:categoria, :slug)");
		$cadastrar->bindValue(':categoria', $categoria, PDO::PARAM_STR);		
		$cadastrar->bindValue(':slug', $slug, PDO::PARAM_STR);		
		   
		
		if($cadastrar->execute()){
		return true;
		}else{
		return false;
		}
		}catch(PDOException $err){
		return false;
		logErrors($err);	
		}
		}
	
	public function CadGaleria($id_categoria, $tmp, $file){
	$name = md5(uniqid(rand(), true)).$file;
	require ('inc/caracteres-especiais.php');
    $pasta = '../assets/img_galeria';
    $largura_max = 800;
    $altura_max	= 800;
    require ('inc/resize.php');
    $result = upload($tmp, $name, $largura_max, $altura_max, $pasta);		
	if($result != ""){
	try{
	$cadastrar = self::conn()->prepare("INSERT INTO galeria (id_categoria, foto) VALUES(:idcat, :img)");	
	$cadastrar->bindValue(':idcat', $id_categoria, PDO::PARAM_STR);		
	$cadastrar->bindValue(':img', $name, PDO::PARAM_STR);		
	if($cadastrar->execute()){
	return true;
	}else{
	return false;
	}
	}catch(PDOException $err){
	return false;
	logErrors($err);	
	}
	}else{
	return false;
	}
	}
	
	public function upImg_galeria($tmp, $file){
	$name = md5(uniqid(rand(), true)).$file;
	require ('inc/caracteres-especiais.php');
	$pasta = 'images';
    $largura_max = 1200;
    $altura_max	= 1200;
    require ('inc/resize.php');		
	$result = upload($tmp, $name, $largura_max, $altura_max, $pasta);
	if($result != ""){
	try{
	$id = $_POST['id'];
    $stmt = self::conn()->prepare("SELECT foto FROM galeria WHERE id = ".$id." ");
    $stmt->execute(array($id));
    $fetchFoto = $stmt->fetchObject();
			
    unlink('../assets/img_galeria/'.$fetchFoto->foto);			
	
    $stmt = self::conn()->prepare("UPDATE galeria SET foto = :imagem WHERE id = :id ");
    $stmt->execute(array(':id'=>$id,':imagem'=>$name));
	
    echo "<div class='alert alert-default' role='alert'><b>Editado</b> <img src='images/load.gif'></div>";
    echo "<meta http-equiv=refresh content='0;URL='>";
    }catch(PDOException $err){
    echo 'Error: ' . $err->getMessage();
    }
    }
    }
	
	public function CadBanner($nome, $tmp, $file){
	$name = md5(uniqid(rand(), true)).$file;
	require ('inc/caracteres-especiais.php');
    $pasta = '../assets/img_banner';
    $largura_max = 1920;
    $altura_max	= 720;
    require ('inc/resize.php');
    $result = upload($tmp, $name, $largura_max, $altura_max, $pasta);		
	if($result != ""){
	try{
	$cadastrar = self::conn()->prepare("INSERT INTO banners (nome, foto) VALUES(:nome, :img)");	
	$cadastrar->bindValue(':nome', $nome, PDO::PARAM_STR);		
	$cadastrar->bindValue(':img', $name, PDO::PARAM_STR);		
	
	if($cadastrar->execute()){
	return true;
	}else{
	return false;
	}
	}catch(PDOException $err){
	return false;
	logErrors($err);	
	}
	}else{
	return false;
	}
	}
	
	public function upImg_banner($tmp, $file){
	$name = md5(uniqid(rand(), true)).$file;
	require ('inc/caracteres-especiais.php');
	$pasta = '../assets/img_banner';
    $largura_max = 1920;
    $altura_max	= 720;
    require ('inc/resize.php');		
	$result = upload($tmp, $name, $largura_max, $altura_max, $pasta);
	if($result != ""){
	try{
	$id = $_POST['id'];
    $stmt = self::conn()->prepare("SELECT foto FROM banners WHERE id = ".$id." ");
    $stmt->execute(array($id));
    $fetchFoto = $stmt->fetchObject();
			
    unlink('../assets/img_banner/'.$fetchFoto->foto);			
	
    $stmt = self::conn()->prepare("UPDATE banners SET foto = :imagem WHERE id = :id ");
    $stmt->execute(array(':id'=>$id,':imagem'=>$name));
	
    echo "<div class='alert alert-default' role='alert'><b>Editado</b> <img src='images/load.gif'></div>";
    echo "<meta http-equiv=refresh content='0;URL='>";
    }catch(PDOException $err){
    echo 'Error: ' . $err->getMessage();
    }
    }
    }
	

	private function verificarUser($email){
	try{
	$verificar = self::conn()->prepare("SELECT id FROM usuarios WHERE email = ? AND status = 1");
	$verificar->execute(array($email));
	return ($verificar->rowCount() >0) ? true : false;
	}catch(PDOException $e){
	return false;
	logErrors($e);
	}
	}
	


}
?>