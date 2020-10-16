<?php 

/*

Clase para conexion y ejecucion de consultas a la base de datos

*/

class ConectionBD{

	static $BDServidor;
	static $BDUsuario;
	static $BDPassword;
	static $BDEsquema;

	// metodo constructor
	function ConectionBD($BDServidor, $BDUsuario, $BDPassword, $BDEsquema){
		self::$BDServidor = $BDServidor;
		self::$BDUsuario = $BDUsuario;
		self::$BDPassword = $BDPassword;
		self::$BDEsquema = $BDEsquema;
	}

	// metodo para establecer conexion con base de datos
	function StartConnection(){

		$connection = new PDO('mysql:host='.self::$BDServidor.';dbname='.self::$BDEsquema, self::$BDUsuario, self::$BDPassword);

		$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$connection->exec("SET CHARACTER SET latin1");

		return $connection;
	}

	// metodo para establecer consulta tipo select y obtener todos los registros de la tabla
	function selectTable($strQuery, $typeResult=PDO::FETCH_ASSOC){
		
		try {

			$connection = $this->StartConnection();
			
			$result = $connection->prepare($strQuery);
			$result->execute();
			$data = [];
			while($record = $result->fetch($typeResult)){
				$data[] = $record;
			}

			$rowCount = $result->rowCount();
			$columnCount = $result->columnCount();
			
			for ($i = 0; $i < $columnCount; $i ++) {
	    		$getColumnMeta = $result->getColumnMeta($i);
	    		$columnName[] = $getColumnMeta['name'];
			}

			$result->closeCursor();

			return [
				'data' => $data, 
				'rowCount' => $rowCount, 
				'columnCount' => $columnCount,
				'columnName' => $columnName
			];

		} catch(PDOException $e) {

			$user = isset($_SESSION["idUser"]) ? $_SESSION["idUser"] : 'system';		

			$errorException = ['message' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile(), 'code' => $e->getCode()];
			
			print_r($errorException); die();
	    
	    } finally {
	    
	    	$result = null;
			$connection = null;
	    
	    }
	}

	// metodo para establecer consulta tipo select y obtener un solo registro de la tabla
	function selectRow($strQuery, $typeResult=PDO::FETCH_ASSOC){

		$strQuery = $strQuery." limit 1";
		$data = $this->selectTable($strQuery, $typeResult);

		switch ($typeResult) {
			case PDO::FETCH_NUM:
				return $data['data'][0];
				break;
			
			default:
				return [
					'data' => !empty($data['data'][0]) ? $data['data'][0] : null,
					'columnCount' => $data['columnCount'],
					'columnName' => $data['columnName']
				];
				break;
		}
		
	}

}


?>