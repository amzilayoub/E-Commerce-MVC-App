<?php

class router{


	protected $url;
	protected $controller = 'indexController';
	protected $method = 'home';
	protected $params = [];

	public function getController(){
		return $this->controller;
	}

	public function getMethod(){
		return $this->method;
	}

	public function getParams(){
		return $this->params;
	}

	public function __construct(){
		if(isset($_GET['url'])){

			/*
				* return the url without GET variables
				* So if we have a url like this : controller/method?var1=val1
				* the result is : controller/method
				* and finally we return just the url without GET variables
			*/
			$myUrl = explode('?', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL))[0];
			$this->url = explode('/', $myUrl);

			//check if the url call a controller
			if (isset($this->url[0]) && !empty($this->url[0]) && is_string($this->url[0])) {
				$this->controller = filter_var(strtolower(rtrim($this->url[0])), FILTER_SANITIZE_STRING) . 'Controller';
				unset($this->url[0]);


				//check if the url call a method
				if (isset($this->url[1]) && !empty($this->url[1]) && is_string($this->url[1])) {
					$this->method = filter_var(strtolower(rtrim($this->url[1])), FILTER_SANITIZE_STRING);;
					unset($this->url[1]);


					//check if the url has a parameters
					$this->params = $this->url ? array_values($this->url) : [];
				}
			}
		}


		try {
			$this->controller = new $this->controller();
			if (method_exists($this->controller, $this->method)) {
				call_user_func_array([$this->controller, $this->method], $this->params);
			} else {
				require_once '../includes/404.html';
			}
			
		} catch (Exception $e) {
			require_once '../includes/404.html';
			exit();
		}
	}
}