<?php

class newsletterController extends controller{
	public function home(){
		if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email']) && !empty($_POST['email'])) {
			$myEmail = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
			
			$isRgisterBefore = newsletterModel::find(['email'], [$myEmail]);
			if (empty($isRgisterBefore)) {
				newsletterModel::insert([$myEmail]);
				print_r(json_encode(['true' => 'Thanx To Register In Our Newsletter !']));
			} else {
				print_r(json_encode(['false' => 'This Email Register Before !']));
				return ;
			}

		} else {
			print_r(json_encode(['false' => 'Please Type A Valide Email !']));
		}
	}
}