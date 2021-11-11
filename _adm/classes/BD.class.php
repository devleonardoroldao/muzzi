<?php 
class BD{
	private static $conn;
	public function __construct(){}
	public static function conn(){
	if(is_null(self::$conn)){
	self::$conn = new PDO('mysql:host=bd_muzi.mysql.dbaas.com.br;dbname=bd_muzi','bd_muzi','b@d_muzi!271');
	self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	return self::$conn;
	}
}
/*
$servidor = "bd_indolorl.mysql.dbaas.com.br";
$usuario = "bd_indolorl";
$senha = 'R6Zyfuzj!$IK$8';
$dbname = "bd_indolorl";
$conn = mysqli_connect($servidor, $usuario, $senha, $dbname);
*/
?>
