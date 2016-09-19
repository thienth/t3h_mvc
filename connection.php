<?php
/**
Tao class Db de ket noi voi co so du lieu
*/
class Db
{
	private static $host = "localhost";
	private static $dbName = "02_mvc";
	private static $dbUName = "root";
	private static $dbPwd = "";
	public static $instance = null;

	// Khoi tao ket noi den csdl va gan vao bien instance sau do tra ve
	public static function GetInstance(){

		if(!self::$instance){
			self::$instance = new PDO("mysql:host=" .self::$host. 
										";dbname=" .self::$dbName,
										self::$dbUName, self::$dbPwd,
										array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
		}
		return self::$instance;
	}

	
}

?>