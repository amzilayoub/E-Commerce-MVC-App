<?php

class contactController extends controller{
	public function home(){
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			if (isset($_POST['firstName']) && !empty($_POST['firstName'])) {
				if (isset($_POST['lastName']) && !empty($_POST['lastName'])) {
					if (isset($_POST['email']) && !empty($_POST['email'])) {
						if (isset($_POST['subject']) && !empty($_POST['subject'])) {
							if (isset($_POST['theMessage']) && !empty($_POST['theMessage'])) {

								mail('amzil.ayoob@gmail.com', 'Message From ' . $_POST['firstName'] . ' ' . $_POST['lastName'], $_POST['theMessage'], 'From: desa@services.com');
								print_r(json_encode(['true' => 'Message Send Successfuly !']));

							} else {
								print_r(json_encode(['false' => 'Message Is Required !']));
							}
			
						} else {
							print_r(json_encode(['false' => 'Subject Is Required !']));
						}
					} else {
						print_r(json_encode(['false' => 'Email Is Required !']));
					}
				} else {
					print_r(json_encode(['false' => 'Last Name Is Required !']));
				}
			} else {
				print_r(json_encode(['false' => 'First Name Is Required !']));
			}
		}
	}
}