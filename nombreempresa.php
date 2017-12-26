<?php  
include 'conexion.php';
$EmpresaID=$_POST['NoticiasID'];
$noticia = intval($EmpresaID);
define('HOST_DB', 'localhost');  //Nombre del host, nomalmente localhost
define('USER_DB', 'sgesecurityfair_SGE');       //Usuario de la bbdd
define('PASS_DB', 'VT!1ag3}#Xp.');           //Contraseña de la bbdd
define('NAME_DB', 'sgesecurityfair_expositores'); //Nombre de la bbdd

conectar();
mysql_set_charset('utf8');  

$query = "SELECT * FROM noticias WHERE NoticiaID =".$noticia;
$resultado = mysql_query($query);//Ejecución de la consulta
 if ($row = mysql_fetch_array($resultado)){
     $empresa = $row["EmpresaIDFK"];
 }
$sql = "SELECT * FROM empresas WHERE EmpresaID=".$empresa;
$result = mysql_query($sql, $link); 
if ($row2 = mysql_fetch_array($result)){ 
   echo '<h1>'.$row2["NombreEmpresa"]."</h1> <br />";
} else { 
echo "¡ No se ha encontrado ningún registro !"; 
} 
mysql_free_result($result);
mysql_close($link);
?>
<?php
// Definimos la conexión
function conectar(){
	global $conexion;  //Definición global para poder utilizar en todo el contexto
	$conexion = mysql_connect(HOST_DB, USER_DB, PASS_DB)
	or die ('NO SE HA PODIDO CONECTAR AL MOTOR DE LA BASE DE DATOS');
	mysql_select_db(NAME_DB)
	or die ('NO SE ENCUENTRA LA BASE DE DATOS ' . NAME_DB);
}
function desconectar(){
	global $conexion;
	mysql_close($conexion);
}
?>
