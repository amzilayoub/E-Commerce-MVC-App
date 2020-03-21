<?php

class signUpController extends controller
{

	//signUp Home Method
	public function home(){
		if (!isset($_SESSION['user'])) {
			$email = '';
			if ($_SERVER['REQUEST_METHOD'] == 'GET' && !isset($_SESSION['user'])){
				$email = isset($_GET['email']) ? $_GET['email'] : '';
			}

			return $this->view('signup',['email' => $email]);
		} else {
			return header("Location: /" . MY_ECOMM);
			exit();
		}
	}

	//Confim Email Method
	public function signUpProcess(){
		if($_SERVER['REQUEST_METHOD'] == 'POST' && !isset($_SESSION['user'])){
			$theEmail = $_POST['email'];
			$imgName = '';

			$username = usersModel::find(['username'],[$_POST['username']]);
			
			//If User Email is exist
			if ($_POST['username'] == '') {

				print_r(json_encode(['false' => 'Username Can\'t Be Empty !']));
				return ;

			} elseif(count($username) == 1) {

				print_r(json_encode(['false' => 'Username Is Userd Before !']));
				return ;

			} else {

				//if username is exist
				$email = usersModel::find(['email'],[$_POST['email']]);
				if ($_POST['email'] == '') {
					print_r(json_encode(["false" => "Email Can't Be Empty !"]));
					return ;

				// Email && Username not exists
				} elseif(count($email) == 1) {

					print_r(json_encode(['false' => 'Email Is Userd Before !']));
					return ;

				} else {

					if ($_POST['checkPassword'] != $_POST['password']) {

						print_r(json_encode(['false' => 'Password Is Incorrect !']));
						return ;
					}

					elseif($_POST['password'] == '') {
						print_r(json_encode(['false' => 'Password Is Empty !']));
						return ;

					} else {
						$_POST['password'] = md5($_POST['password']);
						unset($_POST['checkPassword']);
						if (!empty($_FILES['avatar']['name'])) {
							$path = AVATAR . $_FILES['avatar']['name'];
							
							$imgFileType = strtolower(pathinfo($path, PATHINFO_EXTENSION));

							$strshuffle = str_shuffle("AQWXSZEDCVFRTGBNHYUJKIOLMP0192837465");
						
							$imgName = uniqid($strshuffle) . '.' . $imgFileType;
							$targetFile = AVATAR . $imgName;

							$allowedFormat = ['jpg','jpeg','png','gif'];

							if (in_array($imgFileType, $allowedFormat)) {
								if(!move_uploaded_file($_FILES['avatar']['tmp_name'], $targetFile)){

									$imgName = '';

								}
							} else {
								print_r(json_encode(['false' => 'Format Not Allowed !']));
								return ;
							}
						}
					}
				}
			}

			//now we put the data in the table
			array_push($_POST, $imgName);
			$_POST = array_values($_POST);
			usersModel::insert($_POST);
			$idUser = usersModel::find(['email'],[$_POST[1]])[0]['idUser'];
			$token = uniqid(str_shuffle('WQAZSXMPOLKIUJNCDERFVNHYTGB0192834567'));
			emailVerifiedModel::insert([$idUser,$token]);
			mail($theEmail, 'verification of The Email', SERVER_NAME . 'signup\verifyEmail' . DS . $idUser . DS . $token, 'From: DoNot@test.com');
			print_r(json_encode(['true' => 'Please Check You Email Adress']));

		} else {
			return header("Location: /" . MY_ECOMM);
		}
	}


	//verify Email
	public function verifyEmail($idUser = '',$token = ''){
		//Check if the user is not connect
		if (!isset($_SESSION['user'])) {

			//check if there's a ID USER & TOKEN in the URL
			if ($idUser === '' && $token === '') {

				return header("Location: /" . MY_ECOMM);
				
			} else {

				//activate the account of the user if the token and iduser is true
				$result = emailVerifiedModel::find(['idUser', 'token'], [$idUser, $token]);
				if (count($result) >= 1) {

					emailVerifiedModel::update(['deleted_at' => date('y-m-d')],['idUser = ?' => $idUser]);
					usersModel::update(['confirmedEmail' => '1'], ['idUser = ?' => $idUser]);

					return $this->view('emailVerified');

				//Else mean's there's not user with thistoken and idUser
				} else {

					return header("Location: /" . MY_ECOMM);

				}
			}
		}
	}

}