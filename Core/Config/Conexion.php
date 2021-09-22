<?php
	namespace Core\Config;

	use \PDO;
	
	class Conexion
	{
		private static $instance=NULL;
		
		private function __construct(){}

		private function __clone(){}
		
		public static function getConnect(){
			if (!isset(self::$instance)) {
				$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;

				$host = getEnt('database.default.host');
				$database = getEnt('database.default.name');

				$user = getEnt("database.default.user");
				$pswd = getEnt('database.default.pswd');

				self::$instance= new PDO('mysql:host='.$host.';dbname='.$database,$user,$pswd,$pdo_options);
			}
			return self::$instance;
		}
	}
?>
