<?php

abstract class model extends database{

	//attribute for table
	protected static $table = __CLASS__;
	protected static $query = '';
	protected static $fillable = [];

	//get the table name
	public static function getTable(){
		return str_replace('Model', '', static::$table);
	}


	/*
		* -------- START AUTH --------
		*
		* this Area has some function for Auth
	
	*/

		public static function auth($username,$password,$rememberMe = 'off'){
			
			$username = controller::isString($username);
			$password = controller::isString($password);

			$result = static::find(['username', 'passwordUser'],[$username,$password]);
			if (count($result) === 1) {
				
				if ($result[0]['confirmedEmail'] == 1) {
					unset($result[0]['passwordUser']);
					unset($result[0][3]);
					$_SESSION['user'] = $result[0];

					if ($rememberMe != 'off') {
						setcookie('username', $_SESSION['user']['username'], time() + 31536000, '/');
						setcookie('password', $password, time() + 31536000, '/');
					}

					//which mean's the user is connected
					return 'connected';
				} else {

					//which mean's the user email not verified
					return 'not confirmed';
				}
			} else {

				//wich mean's the email or password is incorrect
				return 'not connected';
			}
		}

	/*
		* -------- END AUTH --------
	*/




	//select All records
	public static function select($colum = '*'){

		$stmt = static::$con->prepare('SELECT ' . $colum . ' FROM ' . static::getTable() . ' WHERE deleted_at IS NULL');
		$stmt->execute();
		return $stmt->fetchAll();
		
	}

	//Update Data
	public static function update($columnUpdatedWithValues, $conditionsWithValues){
		$table = static::getTable();
		static::$query = "UPDATE " . $table . " SET";

		foreach ($columnUpdatedWithValues as $key => $value) {
			static::$query .= " " . $key . " = ? ";
			if (!(end($columnUpdatedWithValues) == $value)){
				static::$query .= ',';
			}
		}

		static::$query .= ' WHERE deleted_at IS NULL ';
		foreach ($conditionsWithValues as $key => $value) {
			static::$query .= ' AND ' . $key;
		}

		$array1 = array_values($columnUpdatedWithValues);
		$array2 = array_values($conditionsWithValues);

		$arrayMerge = array_merge($array1, $array2);

		$stmt = static::$con->prepare(static::$query);
		$stmt->execute($arrayMerge);
		return $stmt->fetchAll();

	}


	//Insert data into a table
	public static function insert($data){
		$tableName = static::getTable();

		static::$query = "INSERT INTO " . $tableName . '(';
		foreach (static::$fillable as $key => $value) {
			if (static::$fillable[count(static::$fillable) - 1] == $value) {

				static::$query .= static::$fillable[$key] . ')';

			} else {

				static::$query .= static::$fillable[$key] . ',';
			}
		}

		static::$query .= " VALUES(" ;

		foreach (static::$fillable as $key => $value) {
			static::$query .= '?';
			if (static::$fillable[count(static::$fillable) - 1] == $value) {
				static::$query .= ')';
			} else {
				static::$query .= ',';
			}
		}

		$stmt = static::$con->prepare(static::$query);
		$stmt->execute($data);
	}


	//find
	public static function find($columns,$values, $selectedColumn = '*'){
		$tableName = static::getTable();
		static::$query = 'SELECT ' . $selectedColumn . ' FROM ' . $tableName . ' WHERE deleted_at IS NULL AND ';
		foreach($columns as $value){
			static::$query .= $value . '=?';
			if (end($columns) != $value) {
				static::$query .= ' AND ';
			}
		}

		$stmt = static::$con->prepare(static::$query);
		$stmt->execute($values);
		return $stmt->fetchAll();
	}


	public static function findJoin($tableFrom, $conditions = [],$condValue = [], $groupBy = '',$having = '' , $orderBy = '' , $limit = '',$column = '*'){
		$tableName = static::getTable();
		static::$query = 'SELECT ' . $column . ' FROM ' . $tableName;

		foreach ($tableFrom as $key => $value) {
			static::$query .= ' INNER JOIN ' . $key . ' ON ' . $key . '.' . $value . '=' . $tableName . '.' . $value;
		}
		static::$query .= ' WHERE ' . $tableName . '.deleted_at IS NULL';
		foreach ($tableFrom as $key => $value) {
			static::$query .= ' AND ' . $key . '.deleted_at IS NULL ';
		}

		$valuesForExecute = [];

		if ($conditions !== []) {
			foreach ($conditions as $value) {
				static::$query .= ' AND ' . $value;
			}
			$valuesForExecute = $condValue;
		}

		if ($groupBy !== '') {
			static::$query .= ' GROUP BY ' . $groupBy;
		}

		if ($having !== '') {
			static::$query .= ' HAVING ' . $having;
		}

		if ($orderBy !== '') {
			static::$query .= ' ORDER BY ' . $orderBy;
		}


		if ($limit !== '') {
			static::$query .= ' LIMIT ' . $limit;
		}



		$stmt = static::$con->prepare(static::$query);
		$stmt->execute($valuesForExecute);
		return $stmt->fetchAll();
	}



	//SoftDelete
	public static function softDelete($columnWithValue){
		return static::update(['deleted_at' => date('y-m-d')], $columnWithValue);
	}

	//Delete a row
	public static function delete($columnWithValue){
		$table = static::getTable();
		static::$query = "DELETE FROM " . $table . " WHERE ";
		foreach ($columnWithValue as $key => $value) {

			static::$query .= $key . ' = ? ';

			end($columnWithValue);

			if (key($columnWithValue) != $key) {
				static::$query .= ' AND ';
			}
		}

		$valuesToExec = array_values($columnWithValue);
		$stmt = static::$con->prepare(static::$query);
		$stmt->execute($valuesToExec);
		return $stmt;
	}
	
}