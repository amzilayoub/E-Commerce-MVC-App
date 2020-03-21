<?php

class controller
{

	public static function isNumeric($var){
		return (filter_var($var,FILTER_SANITIZE_NUMBER_INT));
	}

	public static function isString($var){
		return (filter_var($var,FILTER_SANITIZE_STRING));
	}

	public function view($view, $data = []){
		require_once VIEW . DS . $view . '.php';
	}
	
}