<?php

class authController extends controller
{

	//Login Method
	public function login(){
		
		if ($_SERVER['REQUEST_METHOD'] == 'POST' && !isset($_SESSION['user'])) {

			if (isset($_POST['username']) && !empty($_POST['username']) && is_string($_POST['username']) && isset($_POST['password']) && !empty($_POST['password']) && is_string($_POST['password'])) {
				$rememberMe = isset($_POST['rememberMe']) ? $_POST['rememberMe'] : 'off';
				$isAuth = usersModel::auth($_POST['username'],md5($_POST['password']),$rememberMe);
				if ($isAuth == 'not connected') {

					print_r(json_encode(['false'=> 'something Wrong !']));
				} elseif($isAuth == 'connected') {

					print_r(json_encode(['true' => 'connected !']));
				} else {
					
					print_r(json_encode(['false' => 'Please Verify Your Email !']));
				}
			} else {

			}
		} else {
			return header("Location: /" . MY_ECOMM );
		}
	}


	//Forget Password Side Bar Function
	//Send Email To Recover the password
	public function forgetPass(){
		if ($_SERVER['REQUEST_METHOD'] == 'POST' && !isset($_SESSION['user'])) {
			if (isset($_POST['email']) && ! empty($_POST['email'])) {
				$str = 'PAOZIEURYTHGJFKDLSMQNWBXVC1209348756';
				$token = uniqid(str_shuffle($str));

				//check if there's a user with this email
				$result = usersModel::find(['email'],[$_POST['email']]);
				if (count($result) == 0) {
					print_r(json_encode(['false' => "There's no user with this email"]));
				} else {
					$idUser = $result[0]['idUser'];
					$email = $_POST['email'];
					forgetPassModel::insert([$idUser, $token]);

					$isSend = mail($email, 'Recover your password', SERVER_NAME . 'auth\recoverPass' . DS . $idUser . DS . $token, 'From: DoNot@test.com');
					if ($isSend == 0) {
						print_r(json_encode(['false' => "There's an error"]));
					} else {
						print_r(json_encode(['true' => "Check your email to recover your password"]));
					}
				}
			} else {
				print_r(json_encode(['false' => "Please Type a Email !"]));
			}

		} else {
			return header("Location: /" . MY_ECOMM);
		}
	}

	//Recover Password VIEW and Change Password Method
	public function recoverPass($idUser = '', $token = ''){


		//After his click on Change Password
		//This If Condition will work
		if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['idUserForget'])) {
			if (isset($_POST['password']) && !empty($_POST['password']) && isset($_POST['passwordAgain']) && !empty($_POST['passwordAgain'])) {

				if($_POST['password'] === $_POST['passwordAgain']) {

					//update table user column : password
					usersModel::update(['passwordUser' => md5($_POST['password'])],['idUser = ?' => $_SESSION['idUserForget']]);

					//update table forget Password and set a value to the column deleted_at 
					forgetPassModel::update(['deleted_at' => date('y-m-d')],['idUser = ?' => $_SESSION['idUserForget']]);
					unset($_SESSION['idUserForget']);

					print_r(json_encode(['true' => 'Your Password has changed !!']));
				} else {
					print_r(json_encode(['false' => 'Please Type The Same Password']));
				}
			} else {
				print_r(json_encode(['false' => 'Please Type Password In The Two Input !!']));
			}
		} else {

			//forward to home page if the email and the token is null
			if ($idUser === '' && $token === '') {
				return header("Location: /" . MY_ECOMM);
			} else {

				//Check if The token and idUser is in the table Forget Pass
				$result = usersModel::findJoin(['forgetPass' => 'idUser'],['users.idUser = ?' ,'forgetPass.token = ?', 'TIMESTAMPDIFF(MINUTE, forgetPass.created_at, NOW()) <= 30' ,'forgetPass.deleted_at IS NULL'],[$idUser, $token]);
				if (count($result) >= 1) {
					$_SESSION['idUserForget'] = $result[0]['idUser'];
					return $this->view('recoverPassword');
				} else {
					return header("Location: /" . MY_ECOMM);
				}
			}
		}
	}


	//LogOut
	public function logOut(){
		session_unset();
		session_destroy();
		setcookie('username', '', time(), '/');
		setcookie('password', '', time(), '/');
		print_r(json_encode(['true' => 'Logout succefully !!']));
		return ;
	}
}