<?php

class salesController extends controller{

	public function removeFromSales($idProduct = -1){
		if ($idProduct !== -1) {
			if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user'])) {
				salesModel::softDelete(['idBuyer = ?' => $_SESSION['user']['idUser'], 'idProduct = ?' => $idProduct]);
				print_r(json_encode(['true' => 'The Product is Deleted !']));
			} else {
				print_r(json_encode(['false' => 'Please Login To Complete This Operation !']));
			}
		} else {
			print_r(json_encode(['false' => 'Something Wrong !']));
		}
	}
}