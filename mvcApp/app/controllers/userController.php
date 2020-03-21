<?php


class userController extends controller{

	public function home(){
		if (isset($_SESSION['user'])) {
			$myProduct = productModel::findJoin(['sales' => 'idProduct'], ['sales.idBuyer = ?'], [$_SESSION['user']['idUser']]);
			return $this->view('user', ['product' => $myProduct]);
		} else {
			return header("Location: /" . MY_ECOMM);
		}
	}


	public function editProfile(){
		if (isset($_SESSION['user'])) {
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {

				$columnUpdatedWithValues = [];
				$conditionsWithValues = ['idUser = ?' => $_SESSION['user']['idUser']];

				//If Password is Modified
				if ($_POST['password'] != '') {
					if ($_POST['password'] == $_POST['checkPassword']) {

						$columnUpdatedWithValues['password'] = $_POST['password'];

					} else {
						print_r(json_encode(['false' => 'Please Type The Same Password !']));
						return ;
					}

				}
				
				unset($_POST['password']);
				unset($_POST['checkPassword']);

				//check for other Column if updated
				foreach ($_POST as $key => $value) {

					//checkFirst If The Key in the array
					if (isset($_SESSION['user'][$key])) {

						if ($value != $_SESSION['user'][$key] && $value != '') {

							$columnUpdatedWithValues[$key] = $value;
							$_SESSION['user'][$key] = $value;

						}
					}
				}


				//Check For The Avatar
				if (!empty($_FILES['avatar']['name'])) {
					$myAvatar = $_FILES['avatar'];
					$imgFormat = explode('.', $myAvatar['name']);
					$imgFormat = end($imgFormat);
					$allowedFormat = ['jpg', 'png', 'gif', 'jpeg'];
					if (in_array(strtolower($imgFormat), $allowedFormat) >= 0) {

						$imgName = uniqid(str_shuffle("AMZLEKRJTHYGUFIDOSPQWNXBCV0192657483")) . '.' . $imgFormat;
						$targetPath = AVATAR . $imgName;
						if (move_uploaded_file($_FILES['avatar']['tmp_name'], $targetPath)) {
							
							//delete the older avatar
							unlink("uploaded/avatars/" . $_SESSION['user']['avatar']);

							//Update the Value of Session
							$_SESSION['user']['avatar'] = $imgName;
							
							$columnUpdatedWithValues['avatar'] = $imgName;

						} else {
							print_r(json_encode(['false' => 'Something Wrong !']));
							return ;
						}


					} else {
						print_r(json_encode(['false' => 'Format Of Image Not Allowed !']));
						return ;
					}
				}

				if (count($columnUpdatedWithValues) == 0) {
					print_r(json_encode(['false' => 'You\'re Not Making Any Change !']));
				} else {
					usersModel::update($columnUpdatedWithValues,$conditionsWithValues);
					print_r(json_encode(['true' => 'Your Information Updated Succesfully !']));
				}
				return ;
			} else {
				return $this->view('editProfile');
			}
		} else {
			return header("Location: /" . MY_ECOMM);
		}
	}

}