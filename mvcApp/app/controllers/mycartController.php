<?php

class myCartController extends controller{

	public function home(){
		return $this->view('myCart');
	}

	public function addToCart($idProduct = -1){
		if ($idProduct === -1) {
			print_r(json_encode(['false' => "there's no product to add !"]));
			return ;
		} elseif($_SERVER['REQUEST_METHOD'] == 'POST' && is_numeric($idProduct)){
			if (isset($_SESSION['user'])) {
				
				$cartModel = myCartModel::find(['idProduct', 'idUser'], [$idProduct, $_SESSION['user']['idUser']]);

				if (count($cartModel) >= 1) {

					myCartModel::update(['amount' => $cartModel[0]['amount'] + $_POST['qty']], [' idProduct = ? ' => $idProduct, ' idUser = ? ' => $_SESSION['user']['idUser']]);
					print_r(json_encode(['true' => "Amount Added Succefully !"]));

				} else {

					myCartModel::insert([$idProduct, $_SESSION['user']['idUser'] , $_POST['qty']]);
					print_r(json_encode(['true' => "Product Added Succefully !"]));
					
				}

				return ;
				
			} else {

				print_r(json_encode(['false' => 'Please Login To Add This Product To Your Cart !']));
				return ;

			}
			return ;
		} else {
			return header('Location: /' . MY_ECOMM);
		}
	}


	public function removeProduct($idProduct = - 1){
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {

			if ($idProduct != -1 && is_numeric($idProduct)) {

				if (isset($_SESSION['user'])) {

					myCartModel::delete(['idUser' => $_SESSION['user']['idUser'], 'idProduct' => $idProduct]);
					print_r(json_encode(['true' => 'Product Removed Succefully !']));
					return ;

				} else {
					print_r(json_encode(['false' => 'Please Login to Remove This Product !']));
					return ;
				}

			} else {
				print_r(json_encode(['false' => 'There\'s no product selected !']));
				return ;
			}

		} else {

			print_r(json_encode(['false' => 'Something Wrong !']));
			return ;
		}
	}
}