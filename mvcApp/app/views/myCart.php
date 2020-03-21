<?php
	$title = 'My Cart';
	$noHomePage = '';
	require_once HEADER;
?>

	<!-- +------------- START MY ITEMS PAGE -------------+ -->
		<section class="loadingThisSection container myItemsPage">
			<h1><span>My Cart</span></h1>
			<div class="allItems">
				<?php
					if (isset($_SESSION['myCart'])) {
						foreach ($_SESSION['myCart'] as $value) {
							$post = '<div class="item">';
							$post .= '<div class="img">';
							$post .= '<img src="uploaded/productImg/' . $value['img'] . '" />';
							$post .= '<a href="product/show/' . $value['idProduct'] . '"></a>';
							$post .= '</div>';
							$post .= '<div class="text">';
							$post .= '<h2>' . $value['name'] . '</h2>';
							$post .= '<h4>' . $value['price'] . ' $</h4>';
							$post .= '<div class="manipul">';
							$post .= '<div data-product="' . $value['idProduct'] . '" class="removeMyCart">';
							$post .= '<i class="la la-close"></i>';
							$post .= '<span>Remove</span>';
							$post .= '</div>';
							$post .= '<div class="checkOutButton">';
							$post .= '<i class="la la-check-circle"></i>';
							$post .= '<span>Buy</span>';
							$post .= '</div>';
							$post .= '</div>';
							$post .= '</div>';
							$post .= '</div>';
							echo $post;
						}
					} else {

					}
				?>

								
								
							
						</div>
					</div>
				</div>
			</div>
			<?php
				if (isset($_SESSION['myCart']) && count($_SESSION['myCart']) > 0) {
					$post = '<div class="checkOutButton checkOut">';
					$post .= '<a href="#">CheckOut</a>';
					$post .= '</div>';
					echo $post;

				} else {
					echo '<h2 class="zeroItems"></span>There is 0 Item In Your Cart !</span></h2>';
				}
			?>
			
				
			
		</section>
	<!-- +------------- END MY ITEMS PAGE -------------+ -->

<?php
	require_once FOOTER;
?>