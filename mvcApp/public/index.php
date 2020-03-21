<?php
session_start();

//define the directory separetor => result : /
define('DS', DIRECTORY_SEPARATOR);

/*
	* We call dirname inside a dirname to go back from webroot folder to myMVC folder
	* So The Result of dirname(__FILE__) is : C:\xampp\htdocs\mvcApp\public
	* But the result of dirname(dirname(__FILE__)) is : C:\xampp\htdocs\mvcApp
*/
define('APP', dirname(dirname(__FILE__)) . DS . 'app');
define('MY_ECOMM', 'works' . DS . 'mvcApp');
define('SERVER_NAME', $_SERVER['SERVER_NAME'] . DS . MY_ECOMM . DS);


//here we define the path of some directory
define('EROR404', dirname(dirname(__FILE__)) . DS . 'includes' . DS . '404.html');
define('HEADER', dirname(dirname(__FILE__)) . DS . 'includes' . DS . 'header.php');
define('FOOTER', dirname(dirname(__FILE__)) . DS . 'includes' . DS . 'footer.php');
define('PUBLIC_DIR', dirname(dirname(__FILE__)) . DS . 'public' . DS);
define('AVATAR', PUBLIC_DIR . 'uploaded' . DS . 'avatars' . DS);
define('PRODUCT_IMG', PUBLIC_DIR . 'uploaded' . DS . 'productImg' . DS);
define('CONTR', APP . DS . 'controllers');
define('CORE', APP . DS . 'core');
define('MODEL', APP . DS . 'models');
define('VIEW', APP . DS . 'views');

//autoload file
require_once '../app/autoload.php';
require_once '../app/database.php';

database::connect();


//instance object from class app and start the app
$app = new app;