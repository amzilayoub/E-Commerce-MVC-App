<?php

class database{

	public static $con;

	protected static $dbInfo = [
		'dbType'	=> 'mysql',
		'host'  	=> 'sql101.hostkda.com',
		'dbname'	=> 'hkda_23446369_ecomm',
		'user'  	=> 'hkda_23446369',
		'pass'  	=> 'RANI9ASH',
	];

	public static function connect(){
		$dsn = static::$dbInfo['dbType'] . ':' . 
				'host=' . static::$dbInfo['host'] . ';' .
				'dbname=' . static::$dbInfo['dbname'];

		$user = static::$dbInfo['user'];
		$pass = static::$dbInfo['pass'];
		try {
			static::$con = new PDO($dsn,$user,$pass);

		} catch (PDOException $e) {
			echo $e;
		}
	}
}