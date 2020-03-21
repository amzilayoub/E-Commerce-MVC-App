<?php
	$title = 'Add Product';
	$noHomePage = '';
	require_once HEADER;
?>

		<!-- +------------- START ADD PRODUCT PAGE -------------+ -->
		<section class="loadingThisSection addProuctPage addProduct signUp container marginTopBottom">
			<h1><span>Add Product</span></h1>
			<div class="form">
				<form method="POST" action="product/addProduct" enctype="multipart/form-data">
					<div class="productImg fileUpload">
						<span class="title">Product Images</span>
						<label for="upload">
							<span class="customUpload">Upload</span>
							<input required id="upload" type="file" name="img[]" multiple />
						</label>
						<h6><span>0</span> Files Selected</h6>
						
					</div>
					<div>
						<input required placeholder="Name" type="text" name="name" />
					</div>
					<div>
						<textarea required placeholder="Description" name="description"></textarea>
					</div>
					<div>
						<input placeholder="Price" required type="number" name="price" />
					</div>
					<div>
						<select name="sex">
							<option value=""></option>
							<option value="male">Male</option>
							<option value="female">Female</option>
						</select>
					</div>
					<div>
						<select name="idSize">
							<?php
								foreach ($data['productSize'] as $value) {
									$option = '<option value="' . $value['idSize'] .'">';
									$option .= $value['size'] . "</option>";
									echo $option;
								}
							?>
						</select>
					</div>
					<div>
						<select name="season">
							<option value=""></option>
							<option value="Spring">Spring</option>
							<option value="Summer">Summer</option>
							<option value="Fall">Fall</option>
							<option value="Winter">Winter</option>
						</select>
					</div>
					<div>
						<input placeholder="Amount" required type="number" name="amount" />
					</div>
					<div>
						<input placeholder="Beand" required type="text" name="brand" />
					</div>
					<div>
						<input name="tags" type="text" placeholder="Press ; After a single tag" />
						<input required type="hidden" name="realTags">
					</div>
					<div class="tags">
					</div>
					<div>
						<input type="submit" value="Add Product" />
						<input class="resetBtn" style="display: none;" type="reset" name="reset">
					</div>
				</form>
			</div>
		</section>
		<!-- +------------- END ADD PRODUCT PAGE -------------+ -->
<?php
	require_once FOOTER;
?>