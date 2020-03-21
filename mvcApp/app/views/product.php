<?php
	$title = $data['product'][0]['name'];
	$noHomePage = '';
	require_once HEADER;

?>

<!-- +------------- START PRODUCT  -------------+ -->
		<section class="marginTopBottom product container">
			<div class="fullProduct">
				<div class="img">
					<?php
						echo '<img src="uploaded/productImg/' . $data['img'][0]['img'] . '" />';
					?>
					
					<div>
						<?php
							for($i = 1; $i < count($data['img']) ; $i++){
								echo '<img src="uploaded/productImg/' . $data['img'][$i]['img'] . '" />';
							}
						?>
					</div>
				</div>
				<div class="info">
					<h6 class="tags">
						Tags :
						<?php
						$tags = array_filter(explode(';', $data['tags'][0]['tag']));
							foreach ($tags as $tag) {
								echo '<a href="product/search/' . $tag . '"><span>' . $tag . '</span></a>';
							}
						?>
					</h6>
					<h1 class="title"><?php echo $data['product'][0]['name']; ?></h1>
					<div class="review">
						<form action="rate/addRate/<?php echo $data['product'][0]['idProduct']; ?>" class="rating showProductRating">
							<input value="5" id="r5" type="radio" name="rating" />
							<label for="r5"></label>
							<input value="4" id="r4" type="radio" name="rating" />
							<label for="r4"></label>
							<input value="3" id="r3" type="radio" name="rating" />
							<label for="r3"></label>
							<input value="2" id="r2" type="radio" name="rating" />
							<label for="r2"></label>
							<input value="1" id="r1" type="radio" name="rating" />
							<label for="r1"></label>
							<div style="width :<?php echo $data['rating'][0]['rating'] . '%'; ?>" class="ratingParent">
								
								<span class="theRating">
									<span>
										<i class="la la-star"></i>
										<i class="la la-star"></i>
										<i class="la la-star"></i>
										<i class="la la-star"></i>
										<i class="la la-star"></i>
									</span>
								</span>
							</div>
						</form>
						<a data-scroll="reviews" >(<?php echo count($data['review']); ?> Reviews)</a>
						<a data-scroll="reviews" >Write A Review</a>
					</div>
					<h2 class="price">
						<?php 
							if (isset($data['product'][0]['newPrice'])) {
								echo '<span class="newPrice">' . $data['product'][0]['newPrice'] . ' $</span>';
								echo '<span class="oldPrice">' . $data['product'][0]['price'] . ' $</span>';
							} else {
								echo '<span class="newPrice">' . $data['product'][0]['price'] . ' $</span>';
							}
						?>
						
					</h2>
					<ul class="brandStock">
						<li>Brand :<span><?php echo $data['product'][0]['brand']; ?></span></li>
						<li>Availabillity :<span>In Stock</span></li>
					</ul>
					<p><?php echo $data['product'][0]['description']; ?></p>
					<div class="addToCard">
						<form class="addToCardForm" method="POST" action="myCart/addToCart/<?php echo $data['product'][0]['idProduct']; ?>">
							<span>Qty:</span>
							<input type="number" name="qty" value="1" />
							<input type="submit" value="Add To Card" />
						</form>
					</div>
					<a href="like/addRemoveLike/<?php echo $data['product'][0]['idProduct']; ?>" class="like <?php
						
						if (count($data['like']) == 1) {
							echo 'onAddLike';
						} 

						?>">
						<i class="la la-heart-o"></i>
						<span>Like this Product</span>
					</a>
				</div>
			</div>
			<h1><span>Reviews</span></h1>
			<div id="reviews" class="reviews">
				<form method="POST" action="product/addReview/<?php echo $data['product'][0]['idProduct']; ; ?>">
					<textarea maxlength="500" name="review"></textarea>
					<input type="submit" value="Add" />
				</form>
				<div class="userInfo">
					<span class="username"><?php echo $_SESSION['user']['username']; ?></span>
					<span class="avatar"><?php echo $_SESSION['user']['avatar']; ?></span>
				</div>
				<ul>
					<?php
						foreach ($data['review'] as $review) {
							$post = '<li>';
							$post .= '<a style="background-image: url(uploaded/avatars/' . $review['avatar'] . ')" class="img" href="#"></a>';
							$post .= '<div class="theReview">';
							$post .= '<h6><span>' . $review['username'] . '</span></h6>';
							$post .= '<p>' . $review['review'] . '<p>';
							$post .= "<div>";
							$post .= "<li>";
							echo $post;
						}
					?>

				</ul>
			</div>
		</section>
		<!-- +------------- END PRODUCT -------------+ -->

<?php

	require_once FOOTER;

?>