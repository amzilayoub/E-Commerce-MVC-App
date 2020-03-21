<?php

class likeController extends controller{


	public function home(){
		if (isset($_SESSION['user'])) {

			$myItems = productModel::findJoin(['likes' => 'idProduct', 'productImg' => 'idProduct'],['likes.idUser = ?'],[$_SESSION['user']['idUser']],'product.idProduct','','likes.created_at DESC');
			return $this->view("productLiked", $myItems);

		} else {
			return header("Location: /" . MY_ECOMM);
		}
	}

	public function addRemoveLike($idProduct = -1){
		if ($idProduct != -1) {
			if (isset($_SESSION['user'])) {
				if ($_SERVER['REQUEST_METHOD'] == 'POST') {
					if ($_GET['classLike'] != 'onAddLike') {
						//addLike
						likesModel::insert([$idProduct, $_SESSION['user']['idUser']]);
						print_r(json_encode(['true' => 'add Like']));
					} else {
						//Remove Like
						$var = likesModel::delete(['idProduct' => $idProduct, 'idUser' => $_SESSION['user']['idUser']]);
						print_r(json_encode(['true' => 'Delete succefully']));

					}
					return ;
				} else {

				print_r(json_encode(['false' => 'Something Wrong !']));
				
				}
			} else {
				print_r(json_encode(['false' => 'Please Log In To Like this product !']));
			}
		} else {
			return header('Location: /' . MY_ECOMM);
		}
	}

}