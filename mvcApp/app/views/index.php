<?php
	$title = 'Welcome In DESA E-Commerce';
	require_once HEADER;
?>
		<!-- +------------- START HEADER -------------+ -->
        <header>
			<div class="images">
				<div class="img">
					<div class="overlay"></div>
					<img src="img/h%20(4).jpg" />
				</div>
				<div class="img">
					<div class="overlay"></div>
					<img src="img/h%20(3).jpg" />
				</div>
				<div class="img">
					<div class="overlay"></div>
					<img src="img/h%20(2).jpg" />
				</div>
				<div class="img">
					<div class="overlay"></div>
					<img src="img/h%20(5).jpg" />
				</div>
				<div class="img">
					<div class="overlay"></div>
					<img style="object-position: bottom;" src="img/h%20(8).jpg" />
				</div>
				<div class="img">
					<div class="overlay"></div>
					<img src="img/h%20(11).jpg" />
				</div>
				<div class="img">
					<div class="overlay"></div>
					<img src="img/h%20(12).jpg" />
				</div>
			</div>
			<div class="container offer">
				<div class="content">
					<div class="text">
						<h1>Offer<span>50%</span></h1>
						<p>Hello World Hello World Hello World</p>
					</div>
					<div class="btn">
						<a href="#topDiscount">
							<span>Get Start</span>
						</a>
					</div>
				</div>
			</div>
			<div class="container socialMedia">
					<ul>
						<li>
							<a href="">
								<i class="la la-facebook"></i>
							</a>
						</li>
						<li>
							<a href="">
								<i class="la la-google"></i>
							</a>
						</li>
						<li>
							<a href="">
								<i class="la la-instagram"></i>
							</a>
						</li>
						<li>
							<a href="">
								<i class="la la-whatsapp"></i>
							</a>
						</li>
					</ul>
				</div>
		</header>
        <!-- +------------- END HEADER -------------+ -->
		<!-- +------------- START TOP DISCOUT -------------+ -->
		<section id="topDiscount" class="topDiscount container">
			<h1><span>Top Discount</span></h1>
			<div class="seeAll">
				<p>This is discount section</p>
				<a href="product/search/-1">See All</a>
			</div>
			<div class="allItems marginTopBottom">
				<!-- I need just to put the data that's comming from the controller -->
				<?php
					foreach ($data['topDiscount'] as $value) {
					$post = '<div style="background-image: url(uploaded/productImg/' . $value['img'] . ');" class="item showOnScroll">';
					$post .= '<div class="text">';
					$post .= '<h6>' . $value['name'] . '</h6>';
					$postRating = (isset($value['rating']) && !empty($value['rating'])) ? $value['rating'] : '0';
					$post .= '<div style="    width: 100px;position: relative;margin-right: 0;" class="rating">
								<span style="    position: absolute;left: 0;width: 100px;">
									<i class="la la-star"></i>
									<i class="la la-star"></i>
									<i class="la la-star"></i>
									<i class="la la-star"></i>
									<i class="la la-star"></i>
								</span>
								<span style="width : ' . $postRating . '%" class="theRating">
									<span>
										<i class="la la-star"></i>
										<i class="la la-star"></i>
										<i class="la la-star"></i>
										<i class="la la-star"></i>
										<i class="la la-star"></i>
									</span>
								</span>
							</div>';
					$post .= '<h4><span>' . $value['price'] . '$</span></h4>';
					$post .= '<p>' . substr($value['description'], 0,100) . '...</p>';
					$post .= '<div class="btn">';
					$isLiked = isset($value['ProductIsLiked']) && $value['ProductIsLiked'] == 1 ? 'onAddLike' : '';
					$post .= '<a class="like ' . $isLiked . '" href="like/addRemoveLike/' . $value['idProduct'] . '"><i class="la la-heart-o"><span> ' . $value['likeCount'] . '</span></i></a>';
					$post .= '<a href="product/show/' . $value['idProduct'] . '"><i class="la la-link"></i></a>';
					$post .= '</div>';
					$post .= '</div>';
					$post .= '<span>-' . $value['discount'] . '%</span>';
					$post .= '</div>';
					echo $post;
					}
				?>
					
			</div>
		</section>
		<!-- +------------- END TOP DISCOUNT -------------+ -->
		<!-- +------------- START TOP SALES -------------+ -->
		<section class="loadingThisSection topSales container showOnScroll">
			<h1><span>Top Sales</span></h1>
			<div class="btnSlider">
				<i class="la la-angle-left"></i>
				<i class="la la-angle-right"></i>
			</div>
			<div class="allItems">
				<?php 
					for ($i = 0 ; $i < count($data['topSales']); $i++) {
						if ($i == 1) {
							$post = '<div class="animateItem item">';
						} else {
							$post = '<div class="item">';
						}
						$post .= '<div style="background-image: url(uploaded/productImg/' . $data['topSales'][$i]['img'] . ')" class="img"></div>';
						$post .= '<div class="text">';
						$post .= '<h1>' . $data['topSales'][$i]['name'] . '</h1>';
						$post .= '<h4>' . $data['topSales'][$i]['price'] . '$</h4>';
						$post .= '<p>' . substr($data['topSales'][$i]['description'], 0, 200) . '</p>';
						$post .= '<div class="btn">';
						$post .= '<a class="addToCardBtn" href="#"><i class="la la-cart-plus"></i></a>';
						$post .= '<a href="product/show/' . $data['topSales'][$i]['idProduct'] . '"><i class="la la-arrow-right"></i></a>';
						$post .= '<form class="hidden addToCardForm" action="myCart/addToCart/' . $data['topSales'][$i]['idProduct'] . '"><input type="number" name="qty" value="1"></form>';
						$post .= '</div>';
						$post .= '</div>';
						$post .= '</div>';
						echo $post;
					}

				?>
			</div>
		</section>
		<!-- +------------- END TOP SALES -------------+ -->
		<!-- +------------- START RECOMMENDATION -------------+ -->
		<section class="loadingThisSection suggestion container marginTopBottom">
			<h1><span>suggestion</span></h1>
			<div class="btnSlider">
				<i class="la la-angle-left"></i>
				<i class="la la-angle-right"></i>
			</div>
			<div class="allItems">

				<?php 
					for ($i = 0 ; $i < count($data['sugg']); $i++) {
						if ($i == 1) {
							$post = '<div class="animateItem item">';
						} else {
							$post = '<div class="item">';
						}
						$post .= '<div style="background-image: url(uploaded/productImg/' . $data['sugg'][$i]['img'] . ')" class="img"></div>';
						$post .= '<div class="text">';
						$post .= '<h4>' . $data['sugg'][$i]['name'] . '</h4>';
						$post .= '<p>' . substr($data['sugg'][$i]['description'], 0, 150) . '$</p>';
						$post .= '<a href="product/show/' . $data['sugg'][$i]['idProduct'] . '">See More</a>';
						$post .= '</div>';
						$post .= '<div class="btn">';
						$post .= '<a class="addToCardBtn" href="#"><i class="la la-cart-plus"></i></a>';
						$post .= '<a href="product/show/' . $data['sugg'][$i]['idProduct'] . '"><i class="la la-arrow-right"></i></a>';
						$post .= '<form class="hidden addToCardForm" action="myCart/addToCart/' . $data['sugg'][$i]['idProduct'] . '"><input type="number" name="qty" value="1"></form>';
						$post .= '</div>';
						$post .= '</div>';
						echo $post;
					}

				?>
			</div>
		</section>
		<!-- +------------- END RECOMMENDATION -------------+ -->
		<!-- +------------- START CATEORIE -------------+ -->
		<section class="categories container marginTopBottom">
			<h1><span>Most Used Tag</span></h1>
			<ul class="allCat showAllOnScroll">
				<?php

					for ($i = 0; $i < 12; $i++) {
						$post = '<li class="itemShow">';
						$post .= '<a href="product/search/' . ucfirst($data['cat'][$i]) . '">';
						$post .= '<i class="la la-home"></i>';
						$post .= '<span>' . ucfirst($data['cat'][$i]) . '</span>';
						$post .= '</a>';
						$post .= '</li>';
						echo $post;
					}
					
				?>
			</ul>
		</section>
		<!-- +------------- END CATEORIE -------------+ -->

<?php

	require_once FOOTER;
?>