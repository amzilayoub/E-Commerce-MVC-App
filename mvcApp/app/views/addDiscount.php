<?php
	$title = 'Add Discount';
	$noHomePage = '';
	require_once HEADER;
?>
		
		<!-- +------------- START ADD DISCOUNT PAGE -------------+ -->
		<section class="loadingThisSection addDiscountPage addDiscount addProduct signUp container marginTopBottom">
			<h1><span>Add Discount</span></h1>
			<div class="form">
				<form method="POST" action="product/addDiscount">
						<?php
							$div = '<div';
								if (count($data) == 0) {
									$div .= ' class="zeroDiscount">';
									echo $div;
									echo '<h6 class="zeroDiscount">All Your Product has a discount or you don\'t have any proucts</h6>';
									echo '<a href="product/discount">Product With Discount</a>';
								} else {
									$div .= '>';
									echo $div;
									echo '<select name="idProduct">';
									echo '<option value="*">All</option>';
									foreach ($data as $key => $value) {
										echo '<option value="' . $value['idProduct'] . '">' . $value['name'] . '</option>';
									}
									echo '</select>';
								}
							echo '</div>';
						?>
					<div>
						<?php 
							if (count($data) !== 0){
								echo '<input placeholder="Amount..." required type="text" name="amount" />';
							}
						?>
					</div>
					<div>
						<?php 
							if (count($data) !== 0){
								echo '<input type="submit" value="Add Discount To Product" />';
							}
						?>
					</div>
				</form>
			</div>
		</section>
		<!-- +------------- END ADD DISCOUNT PAGE -------------+ -->
		<div class="bigMarginTop"></div>

<?php
	require_once FOOTER;
?>