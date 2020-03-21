<?php
	$title = 'Edit Profile';
	$noHomePage = '';
	require_once HEADER;
?>
		<!-- +------------- START SIGNUP PAGE -------------+ -->
		<section class="loadingThisSection editProfile signUp container marginTopBottom">
			<h1><span>Edit Profile</span></h1>
			<div class="form">
				<form enctype="multipart/form-data" method="POST" action="user/editProfile">
					<div class="fileUpload">
						<span class="title">Avatar</span>
						<label for="upload">
							<span class="customUpload">Upload</span>
							<input id="upload" type="file" name="avatar" />
						</label>
					</div>
					<div>
						<input  placeholder="Password" type="password" name="password" />
					</div>
					<div>
						<input  placeholder="Type Password Again" type="password" name="checkPassword" />
					</div>
					<div>
						<input  placeholder="Birthday" type="date" name="birthday" value="<?php echo $_SESSION['user']['birthday'] ;?>" />
					</div>
					<div>
						
						<input  placeholder="Adress" type="tel" name="adresse" value="<?php echo $_SESSION['user']['adresse'] ;?>" />
					</div>
					<div>
						
						<input  placeholder="Zip Code" type="number" name="zipCode" value="<?php echo $_SESSION['user']['zipCode'] ;?>" />
					</div>
					<div>
						
						<input  placeholder="About Me" type="text" name="aboutMe" value="<?php echo $_SESSION['user']['aboutMe'] ; ?>" />
					</div>
					<div>
						<input type="submit" value="Edit Profile" />
					</div>
				</form>
			</div>
		</section>
		<!-- +------------- END SIGNUP PAGE -------------+ -->

<?php
	require_once FOOTER;
?>