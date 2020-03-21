<?php

class app{

	public function __construct(){

		//get tags for FOOTER
		if (!isset($_SESSION['tags']['tag'])) {
			
			
		//Product Tags
			$productTags = productTagsModel::select();
			$catExploded = [];
			foreach ($productTags as $values) {
				$tag = explode(";", $values['tag']);
				foreach ($tag as $value) {
					array_push($catExploded, $value);
				}
			}
			$productTags = array_filter($catExploded);
			$productTags = array_values($productTags);
			$productTags = array_unique($productTags);
			$productTags = array_values($productTags);
			$_SESSION['tags'] = $productTags;
		
		}

		//Login if is set to the Cookie
		if (isset($_COOKIE['password']) && isset($_COOKIE['username']) && !isset($_SESSION['user'])) {
			usersModel::auth($_COOKIE['username'],$_COOKIE['password']);
		}


		//Check For MyCart Item
		if (isset($_SESSION['user']['idUser'])) {
			$_SESSION['myCart'] = productModel::findJoin(['myCart' => 'idProduct', 'productImg' => 'idProduct'],['myCart.idUser = ?'],[$_SESSION['user']['idUser']], 'myCart.idProduct', '', 'myCart.created_at DESC');
		}


		//new instance of Router
		(new router());

		
	}
}