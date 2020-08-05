<?php

class database{

	public static $con;

	protected static $dbInfo = [
		'dbType'	=> '',
		'host'  	=> '',
		'dbname'	=> '',
		'user'  	=> '',
		'pass'  	=> '',
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
