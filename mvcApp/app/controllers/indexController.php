<?php

class indexController extends controller
{
	public function home(){

		//Discount Section
		$query = '*, (SELECT (AVG(rate.rating) * 20) FROM rate WHERE rate.idProduct = product.idProduct) AS rating, (SELECT COUNT(likes.idProduct) FROM likes WHERE likes.idProduct = product.idProduct) AS likeCount';
		if (isset($_SESSION['user']['idUser'])) {

			$_SESSION['user']['idUser'] = $this->isNumeric($_SESSION['user']['idUser']);

			$query .= ', (SELECT IF(idUser = ' . $_SESSION['user']['idUser'] . ' AND likes.idProduct = product.idProduct, 1, 0) FROM likes WHERE likes.idProduct = product.idProduct) AS ProductIsLiked';

		}

		$topDiscount =  productModel::findJoin(['productImg' => 'idProduct', 'discount' => 'idProduct'],
												[], [],
												'product.idProduct', '','discount.discount DESC', '0,9', $query);





		//Top Sales Section
		$topSales = salesModel::findJoin(["productImg" => "idProduct", "product" => "idProduct"],[],[],'sales.idProduct', '' ,'sumAmount DESC', '0,9', '*, SUM(sales.amount) AS sumAmount');


		//Suggestion
		$sugg = likesModel::findJoin(["productImg" => "idProduct", "product" => "idProduct"],[],[],'likes.idProduct', '','countProduct DESC', '0,9', '*, SUM(likes.idProduct) AS countProduct');


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
		return $this->view('index', ['topDiscount' => $topDiscount, 'topSales' => $topSales, 'sugg' => $sugg, 'cat' => $productTags]);

	}
}