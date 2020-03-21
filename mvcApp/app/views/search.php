<?php
	$title = 'Search Page !';
	$noHomePage = '';
	require_once HEADER;
?>

		<!-- +------------- START SEARCH FORM -------------+ -->
		<section class="loadingThisSection container formSearch">
			<form method="POST" action="product/search">
				<div class="search">
					<ul>
						<div class="searchBox">
							<li>
								<input type="search" name="searchedItem" />
							</li>
							<li>
								<input type="submit" value="Search" />
							</li>
							<li>
								<a class="advanced" href="#">Advanced</a>
							</li>
						</div>
						<div class="advancedSearch">
							<li>
								<label>Size</label>
								<select name="size">
									<option value="...">...</option>
									<?php
										foreach ($data['productSize'] as $value) {
											$option = '<option value="' . $value['idSize'] .'">';
											$option .= $value['size'] . "</option>";
											echo $option;
										}
									?>
								</select>
							</li>
							<li>
								<label>Price</label>
								<div>
									<input type="text" name="priMin" placeholder="Min"  />
									<input type="text" name="priMax" placeholder="Max"  />
								</div>
							</li>
							<li>
								<label>Sex</label>
								<select name="sex">
									<option value="...">...</option>
									<option value="male">Male</option>
									<option value="female">Female</option>
								</select>
							</li>
							<li>
								<label>Saison</label>
								<select name="season">
									<option value="...">...</option>
									<option value="Spring">Spring</option>
									<option value="Summer">Summer</option>
									<option value="Fall">Fall</option>
									<option value="Winter">Winter</option>
								</select>
							</li>
							<li class="checkbox">
								<label for="onSolde">
									<input id="onSolde" type="checkbox" name="onSolde">
									<span>on Solde</span>
								</label>
							</li>
							<li class="rating">
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
							</li>
						</div>
					</ul>
				</div>
			</form>
		</section>
		<!-- +------------- END SEARCH FORM -------------+ -->
		<!-- +------------- START RESULT -------------+ -->
		<section style="margin-bottom: 400px" class="resultPage result topDiscount container">
			<?php
				if (isset($data['tagDiscount'])) {

					?>

				<!------------- START RESULT -------------+ -->
				<h1><span>Result</span></h1>
				<div class="allItems marginTopBottom">
					<?php 

						foreach ($data['tagDiscount'] as $value) {
							$post = '<div class="item" style="background-image: url(uploaded/productImg/'. $value['img'] . ')">';
							$post .= '<div class="text">';
							$post .= '<h6>' . $value['name'] . '</h6>';
							$post .= '<div class="rating">';
							$post .= '<span>';
							$post .= '<i class="la la-star"></i>';
							$post .= '<i class="la la-star"></i>';
							$post .= '<i class="la la-star"></i>';
							$post .= '<i class="la la-star"></i>';
							$post .= '<i class="la la-star"></i>';
							$post .= '</span>';
							$post .= '<span style="width:' . $value['ratingProduct'] . '%" class="theRating">';
							$post .= '<span>';
							$post .= '<i class="la la-star"></i>';
							$post .= '<i class="la la-star"></i>';
							$post .= '<i class="la la-star"></i>';
							$post .= '<i class="la la-star"></i>';
							$post .= '<i class="la la-star"></i>';
							$post .= '</span>';
							$post .= '</span>';
							$post .= '</div>';
							$post .= '<h4><span>' . $value['price'] . '$</span></h4>';
							$post .= '<p>' . substr($value['description'], 0, 100) . '</p>';
							$post .= '<div class="btn">';
							$isLikedProduct = (isset($value['ProductIsLiked']) && $value['ProductIsLiked'] == 1) ? 'onAddLike' : '';
							$post .= '<a href="like/addRemoveLike/' . $value['idProduct'] . '" class="like ' . $isLikedProduct . '" ><i class="la la-heart-o"><span> ' . $value['countLike'] . '</span></i></a>';
							$post .= '<a href="product/show/' . $value['idProduct'] . '"><i class="la la-link"></i></a>';
							$post .= '</div>';
							$post .= '</div>';
							$post .= '<span>-' .  $value['howMuchdiscount'] . '%</span>';
							$post .= '</div>';
							echo $post;
						}
					?>
				</div>
			<!-- +------------- END RESULT -------------+ -->

					<?php

				} else {

					echo '<h1><span>Please Search For Something</span></h1>';
				
				}
			?>

		</section>

<?php
	require_once FOOTER
?>