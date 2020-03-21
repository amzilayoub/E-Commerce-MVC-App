<?php


//autoload for loading classes
spl_autoload_register('myAutoload');
function myAutoload($className){
	$coreClass = CORE . DS . $className . '.php';
	$controllerClass = CONTR . DS . $className . '.php';
	$modelClass = MODEL . DS . $className . '.php';
	$authClass = MODEL . DS . 'auth' . DS . $className . '.php';

	if (file_exists($coreClass)) {
		require_once $coreClass;
	}

	elseif (file_exists($controllerClass)) {
		require_once $controllerClass;
	}

	elseif (file_exists($modelClass)) {
		require_once $modelClass;
	}

	elseif(file_exists($authClass)){
		require_once $authClass;
	}

	else {
		throw new Exception("File not existe", 1);
	}
}
