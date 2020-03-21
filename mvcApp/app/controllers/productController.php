<?php

class productController extends controller{


	public function home(){
		if (isset($_SESSION['user'])) {


			$myProducts = productModel::findJoin(['productImg' => 'idProduct'],['product.idUser = ?'],[$_SESSION['user']['idUser']],'product.idProduct', '', 'product.created_at DESC');
			return $this->view("allMyProduct",$myProducts);

		} else {
			return header("Location: /" . MY_ECOMM);
		}
	}


	public function removeMyProduct($idProduct = -1){
		if ($idProduct != -1) {
			if (isset($_SESSION['user'])){

				productModel::softDelete(['idUser = ?' => $_SESSION['user']['idUser'], 'idProduct = ?' => $idProduct]);
				print_r(json_encode(['true' => 'Product Deleted Succefully !']));
			
			} else {
				print_r(json_encode(['false' => 'Please Login To Complete This Process !']));
			}

		} else {
			print_r(json_encode(['false' => "There's Not Product Selected !"]));
			
		}
	}

	public function show($idProduct = ''){
		if ($idProduct === '') {
			return header('Location: /' . MY_ECOMM);
		} elseif(is_numeric($idProduct)) {
			$product = productModel::find(['idProduct'],[$idProduct]);
			$tags = productTagsModel::find(['idProduct'],[$idProduct]);
			$rating = rateModel::find(['idProduct'],[$idProduct],'(AVG(rating) * 20) AS rating');
			$img = productImgModel::find(['idProduct'],[$idProduct]);
			$review = reviewsModel::findJoin(['users' => 'idUser'],[' reviews.idProduct = ? '],[$idProduct],'' , '' ,'reviews.created_at DESC');
			$discount = discountModel::find(['idProduct'],[$idProduct]);
			$like = [];
			if (isset($_SESSION['user'])) {
				$like = likesModel::find(['idUser', 'idProduct'], [$_SESSION['user']['idUser'], $idProduct]);
			}

			if (count($product) == 1) {
				if (count($discount) >= 1) {
					$product[0]['newPrice'] = (1 - $discount[0]['discount']/100) *  $product[0]['price'];
				}

				return $this->view('product', ['product' => $product, 'tags' => $tags, 'rating' => $rating, 'img' => $img, 'review' => $review, 'like' => $like]);
			} else {
				return header("Location: /" . MY_ECOMM);
			}

		}
	}



	public function addProduct(){

		if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user']['idUser'])) {
			if (!isset($_POST['idSize']) || empty($_POST['idSize']) || !is_numeric($_POST['idSize']) || $_POST['idSize'] <= 0) {
				print_r(json_encode(['false' => 'Please Select A Valide Size']));
				return;
			}

			if (!isset($_POST['name']) || empty($_POST['name']) || !is_string($_POST['name'])) {
				print_r(json_encode(['false' => 'Please Type A Valide Name']));
				return;
			}

			if (!isset($_POST['description']) || empty($_POST['description']) || !is_string($_POST['description'])) {
				print_r(json_encode(['false' => 'Please Type A Valide Name']));
				return;
			}

			if (!isset($_POST['price']) || empty($_POST['price']) || !is_numeric($_POST['price']) || $_POST['price'] <= 0) {
				print_r(json_encode(['false' => 'Please Type A Valide Price']));
				return;
			}

			if (!isset($_POST['sex']) || empty($_POST['sex']) || !is_string($_POST['sex'])) {
				print_r(json_encode(['false' => 'Please Select A Valide Sex']));
				return;
			}

			if (!isset($_POST['season']) || empty($_POST['season']) || !is_string($_POST['season'])) {
				print_r(json_encode(['false' => 'Please Select A Valide Season']));
				return;
			}

			if (!isset($_POST['amount']) || empty($_POST['amount']) || !is_numeric($_POST['amount']) || $_POST['amount'] <= 0) {
				print_r(json_encode(['false' => 'Please Type A Valide Amount']));
				return;
			}

			if (!isset($_POST['brand']) || empty($_POST['brand']) || !is_string($_POST['brand'])) {
				print_r(json_encode(['false' => 'Please Type A Valide Brand']));
				return;
			}

			$myTagsTest = array_filter(explode(';', $_POST['realTags']));
			if (count($myTagsTest) == 0) {
				print_r(json_encode(['false' => 'Please Type Some Tags !']));
				return;
			}

			$_FILES['img']['name'] = array_filter($_FILES['img']['name']);
			if (empty($_FILES['img']['name'])) {
				print_r(json_encode(['false' => 'Please Upload At Least One Photo !']));
				return ;
			}
			productModel::insert([
					$_SESSION['user']['idUser'],
					$_POST['idSize'],
					$_POST['name'],
					$_POST['description'],
					$_POST['price'],
					$_POST['sex'],
					$_POST['season'],
					$_POST['amount'],
					$_POST['brand']
				]);

			$theInsertedProduct = productModel::select("MAX(idProduct)")[0][0];
			
			productTagsModel::insert([$theInsertedProduct,$_POST['realTags']]);

			$uploadOk = 1;

			for ($i = 0; $i < count($_FILES['img']['name']); $i++) {

				//the path file
				$path = PRODUCT_IMG . $_FILES['img']['name'][$i];

				//get the type of file
				$imgFileType = strtolower(pathinfo($path, PATHINFO_EXTENSION));

				//generate a random name for the images
				$strshuffle = str_shuffle("AQWXSZEDCVFRTGBNHYUJKIOLMP0192837465");
				
				$imgName = uniqid($strshuffle) . '.' . $imgFileType;
				$targetFile = PRODUCT_IMG . $imgName;
				
				//the allowed format
				$allowedFormat = ['jpg','jpeg','png','gif'];
				$check = getimagesize($_FILES['img']['tmp_name'][$i]);
				if (!$check) {

					//which means the file upload is not an img

				} else {

					//which means the file upload is an img
					if (in_array($imgFileType, $allowedFormat)) {
						if (move_uploaded_file($_FILES['img']['tmp_name'][$i], $targetFile)) {
							productImgModel::insert([$theInsertedProduct,$imgName]);
						}
						
					} else {
						print_r(json_encode(['false' => 'Format Not Allowed !']));
						$uploadOk = 0;
					}
				}
			}
			if ($uploadOk === 1) {
				print_r(json_encode(['true' => 'Product Added !']));
			}
		} elseif(isset($_SESSION['user']['idUser'])) {
			$productSize = productSizeModel::select();
			return $this->view('addProduct',['productSize' => $productSize]);
		} else {
			return header("Location: /" . MY_ECOMM);
		}


	}

	public function discount(){
		if (isset($_SESSION['user'])) {

			$MyDiscountProduct = productModel::findJoin(['discount' => 'idProduct', 'productImg' => 'idProduct'],['product.idUser = ?'],[$_SESSION['user']['idUser']],'product.idProduct','', 'discount.created_at DESC');
			return $this->view('productDiscount', $MyDiscountProduct);

		} else {
			return header("Location: /" . MY_ECOMM);
		}
	}

	public function addDiscount(){


		if (isset($_SESSION['user'])) {

			//If The User is connect then will see his products
			$product = productModel::findJoin([],['idUser = ?','idProduct NOT IN (SELECT idProduct FROM discount)'],[$_SESSION['user']['idUser']]);
			if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
				
				return $this->view('addDiscount',$product);

			//If The User choose * then add the same discount to all product
			} elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['amount']) && !empty($_POST['amount'])) {

				if (is_numeric($_POST['amount'])) {

					if ($_POST['amount'] <= 90) {

						if ($_POST['idProduct'] != '*' && isset($_SESSION['user'])) {

							$_POST = array_values($_POST);
							discountModel::insert($_POST);
							print_r(json_encode(['true' => 'The Discount Added Succefully !']));
						} else {

							foreach ($product as $value) {
								$err = discountModel::insert([$value['idProduct'], $_POST['amount']]);
							}

							print_r(json_encode(['true' => 'The Discount Added Succefully !']));

						}
					} else {
						print_r(json_encode(['false' => 'Please Choose A Value Lower Than 90 !']));
					}
				} else {
					print_r(json_encode(['false' => 'Please Enter A Number !']));
				}

			} else {
				print_r(json_encode(['false' => 'Please Enter The Amount !']));
			}


		} else {
			return header("Location: /" . MY_ECOMM);
		}
	}


	public function removeDiscount($idProduct = -1){
		if (isset($_SESSION['user']['idUser'])) {

			if ($idProduct != -1 && $_SERVER['REQUEST_METHOD'] == 'POST') {

				discountModel::delete(['idProduct' => $idProduct]);
				print_r(json_encode(['true' => 'Operation Succefully !']));

			} else {
				print_r(json_encode(['false' => "There's 0 Product Selected !"]));
			}
		} else {
			print_r(json_encode(['false' => 'Please Login To Complete This Operation !']));
		}
	}


	public function addReview($idProduct = -1){
		if ($idProduct != -1) {
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {

				//check if the review is empty
				if ($_POST['review'] != '') {

					//check if the user is login
					if (isset($_SESSION['user'])) {

						reviewsModel::insert([$idProduct, $_SESSION['user']['idUser'], $_POST['review']]);
						print_r(json_encode(['true' => 'Your Review Added Succefully !']));

					} else {
						print_r(json_encode(['false' => 'Please Login To Add A Review !']));
					}
				} else {
					print_r(json_encode(['false' => 'Please Type A Review !']));
				}

			} else {
				return header("Location: /" . MY_ECOMM);
			}
		}
	}


	//Search Prouct
	public function search($tagOrDiscount = ''){
		$productSize = productSizeModel::select();
		if ($_SERVER['REQUEST_METHOD'] == 'POST' || $tagOrDiscount != '') {
			
			$column = "*";
			$tables = ['productImg' => 'idProduct'];
			$conditions = [];
			$condValues = [];
			$having = '';

			if (isset($_POST['searchedItem']) && $_POST['searchedItem'] == '' && $tagOrDiscount == '') {
				
				echo "<h1><span>Please Type Something !</span></h1>";
			
			} else {
				

				//get all Values that i need to show in search Page
				if (!isset($_POST['searchAside'])) {
					$column = "*, (SELECT COUNT(likes.idProduct) FROM likes WHERE likes.idProduct = product.idProduct) AS countLike, (SELECT (AVG(rate.rating) * 20) FROM rate WHERE rate.idProduct = product.idProduct) AS ratingProduct";
					$column .= ', (SELECT discount.discount FROM discount WHERE discount.idProduct = product.idProduct) AS howMuchdiscount';
					if (isset($_SESSION['user'])) {


						$idUser = $this->isNumeric($_SESSION['user']['idUser']);
						//check if user is like some product from searched product
						$column .= ', (SELECT IF(idUser = ' . $idUser . ' AND likes.idProduct = product.idProduct, 1, 0) FROM likes WHERE likes.idProduct = product.idProduct) AS ProductIsLiked';
						

					}
				}


				if ($tagOrDiscount != '') {
					if ($tagOrDiscount == -1) {

						$tables['discount'] = 'idProduct';

					} else {
						$tag = $this->isString($tagOrDiscount);
						$tables['productTags'] = 'idProduct';
						array_push($conditions, 'productTags.tag LIKE ?');
						array_push($condValues,'%' . $tagOrDiscount . '%');
					}
				} else {

					//Which Mean's That the request come from Search Page
					$productName = explode(' ', $_POST['searchedItem']);
					$productName = array_filter($productName);
					$productName = array_values($productName);

					//Search in Tags
					foreach ($productName as $value) {
						$tables['productTags'] = 'idProduct';
						array_push($conditions, '(productTags.tag LIKE ? OR product.name LIKE ?)');
						array_push($condValues,'%' . $value . '%');
						array_push($condValues,'%' . $value . '%');
					}

				}


				//check if the request comme from the search page or from search aside bar
				if (!isset($_POST['searchAside']) && $tagOrDiscount == '') {


					//Product Size
					if ($_POST['size'] != '...') {
						$tables['productSize'] = 'idSize';
						array_push($conditions, 'productSize.idSize = ?');
						array_push($condValues, $_POST['size']);
					}


					//Product Price Min
					if ($_POST['priMin'] != '') {
						array_push($conditions, 'product.price >= ?');
						array_push($condValues, $_POST['priMin']);
					}


					//Product Price Max
					if ($_POST['priMax'] != '') {
						array_push($conditions, 'product.price <= ?');
						array_push($condValues, $_POST['priMax']);
					}


					//Product Sex
					if ($_POST['sex'] != '...') {
						array_push($conditions, 'product.sex = ?');
						array_push($condValues, $_POST['sex']);
					}


					//Product Season
					if ($_POST['season'] != '...') {
						array_push($conditions, 'product.season = ?');
						array_push($condValues, $_POST['season']);
					}


					//Product is on Discount
					if (isset($_POST['onSolde'])) {
						$tables['discount'] = 'idProduct';
					}


					//Product Rating
					if (isset($_POST['rating'])) {
						$tables['rate'] = 'idProduct';
						$having = 'AVG(rate.rating) >= ?';
						array_push($condValues, $_POST['rating']);
					}

				}

				//Search for product
				$searchedProduct =  productModel::findJoin($tables, $conditions, $condValues, 'product.idProduct', $having,'product.created_at DESC', '0,9', $column);
				
				if (count($searchedProduct) > 0) {

					//check if the request comme from the search page or from search aside bar
					if ($tagOrDiscount == '') {

						if (isset($_POST['searchAside'])) {

							return $this->view("miniViews/resultAside", ['product' => $searchedProduct]);
					
						} else {

							return $this->view("miniViews/result", ['product' => $searchedProduct]);

						}

					} else {

						return $this->view('search', ['tagDiscount' => $searchedProduct, 'productSize' => $productSize]);

					}


				} else {


					if ($tagOrDiscount == '') {

						echo "<h1><span>No Such Result</span></h1>";
					
					} else {

						return header("Location: /" . MY_ECOMM . '/product/search');

					}

				}


			}
		} else {

			return $this->view("search", ['productSize' => $productSize]);
		
		}
	}
}