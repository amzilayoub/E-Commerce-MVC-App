<?php
	$title = 'All My Products';
	$noHomePage = '';
	require_once HEADER;
?>

	<!-- +------------- START MY ITEMS PAGE -------------+ -->
		<section class="loadingThisSection container myItemsPage">
			<h1><span>All My Product</span></h1>
			<div class="allItems">
				<?php
					foreach ($data as $value) {
						$post = '<div class="item">';
						$post .= '<div class="img">';
						$post .= '<img src="uploaded/productImg/' . $value['img'] . '" />';
						$post .= '<a href="product/show/' . $value['idProduct'] . '"></a>';
						$post .= '</div>';
						$post .= '<div class="text">';
						$post .= '<h2>' . $value['name'] . '</h2>';
						$post .= '<h4>' . $value['price'] . ' $</h4>';
						$post .= '<div class="manipul">';
						$post .= '<div data-product="' . $value['idProduct'] . '" class="removeMyProduct">';
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
				?>

								
								
							
						</div>
					</div>
				</div>
			</div>
			<?php
				if (count($data) == 0) {

					echo '<h2 class="zeroItems"></span>You Have 0 Items !</span></h2>';

				}
			?>
			
				
			
		</section>
	<!-- +------------- END MY ITEMS PAGE -------------+ -->

<?php

	if (count($data) != 0) {
		echo '<div class="bigMarginTop"></div>';
	}

	require_once FOOTER;
?>