<!------------- START RESULT -------------+ -->
			<h1><span>Result</span></h1>
			<div class="allItems marginTopBottom">
				<?php 
				//print_r($data);
					foreach ($data['product'] as $value) {
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
						$post .= '<span>-' . $value['howMuchdiscount'] . '%</span>';
						$post .= '</div>';
						echo $post;
					}
				?>
			</div>
		<!-- +------------- END RESULT -------------+ -->