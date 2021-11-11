<?php
   function upload($tmp, $arquivo, $max_x, $max_y, $pasta){
   $img		= imagecreatefromjpeg($tmp);
   $original_x	= imagesx($img); //largura
   $original_y	= imagesy($img); //altura
   $diretorio	= $pasta."/".$arquivo;
   if ( ( $original_x > $max_x ) || ( $original_y > $max_y ) ){
   if ( $original_x > $original_y ) {	
   $max_y	= ( $max_x * $original_y ) / $original_x;
	}else{
	$max_x	= ( $max_y * $original_x ) / $original_y;
	}
	$nova = imagecreatetruecolor($max_x, $max_y);
	imagecopyresampled($nova, $img, 0, 0, 0, 0, $max_x, $max_y, $original_x, $original_y);
	imagejpeg($nova, $diretorio);
	imagedestroy($nova);
	imagedestroy($img);
  }else{
  imagejpeg($img, $diretorio);
  imagedestroy($img);
  }
  return($arquivo);  
}
?>
