<?php

class rateController extends controller{

	public function addRate($idProduct = -1){

		if ($idProduct != - 1) {

			if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user']) && isset($_POST['rating'])) {

				$userRate = rateModel::find(['idUser', 'idProduct'], [$_SESSION['user']['idUser'], $idProduct]);
				if (count($userRate) > 0) {

					rateModel::update(['rating' => $_POST['rating']], ['idUser = ?' => $_SESSION['user']['idUser'], 'idProduct = ?' => $idProduct]);

				} else {

					rateModel::insert([$idProduct ,$_SESSION['user']['idUser'], $_POST['rating']]);
				}

				print_r(json_encode(['true' => 'Thanx !']));

			} else {
				print_r(json_encode(['false' => 'Please Login To Rate This Product !']));
				return ;
			}

		} else {
			return header("Location: /" . MY_ECOMM);
		}
	}

}