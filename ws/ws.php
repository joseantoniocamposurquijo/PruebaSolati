<?php 

require_once '../config/config.php'; 
require_once '../database/QueryDatabase.php';


// instanciación de la clase conectionBD para ejecutar consultas a la base de datos
$query = new ConectionBD($BDServidor, $BDUsuario, $BDPassword, $BDEsquema);


// Mostrar un data por Get
if ($_SERVER['REQUEST_METHOD'] == 'GET'){
    if (isset($_GET['id'])){
		$result = $query->selectRow("SELECT * from productos where ProId = '{$_GET['id']}'"); 
		header("HTTP/1.1 200 OK");
		echo json_encode($result['data']);
		exit();
	}else{
		$result = $query->selectTable("SELECT * from productos");
		header("HTTP/1.1 200 OK");
		echo json_encode($result['data']);
		exit();
	}
}

//En caso de que ninguna de las opciones anteriores se haya ejecutado
header("HTTP/1.1 400 Bad Request");

?>
