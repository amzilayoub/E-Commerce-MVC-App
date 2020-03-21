<?php

class checkoutController extends controller
{
	public function home(){
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			print_r(json_encode(['false' => "Sorry, We Don't Have Payment Process Right Now !"]));
		}
	}
}