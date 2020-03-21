<?php
	$title = 'Sign Up';
	$noHomePage = '';
	require_once HEADER;
?>
		<!-- +------------- START SIGNUP PAGE -------------+ -->
		<section class="loadingThisSection signUpPage signUp container marginTopBottom">
			<h1><span>Sign Up</span></h1>
			<div class="form">
				<form enctype="multipart/form-data" method="POST" action="signup/signUpProcess">
					<div>
						<input type="text" name="username" placeholder="Username" />
					</div>
					<div>
						<input placeholder="Email" type="text" name="email" value="<?php
							$email = isset($data['email']) ? $data['email'] : '';
							echo $email;
						 ?>" />
					</div>
					<div>
						<input type="password" name="password" placeholder="Password" />
					</div>
					<div>
						<input type="password" name="checkPassword" placeholder="Confirm Password" />
					</div>
					<div>
						<input type="date" name="birthDay" placeholder="Birthday" />
					</div>
					<div>
						<input type="text" name="adress" placeholder="Adress" />
					</div>
					<div>
						<input type="number" name="zipCode" placeholder="Zip Code" />
					</div>
					<div>
						<input type="text" name="aboutMe" placeholder="About Me" />
					</div>
					<div class="fileUpload">
						<span class="title">Avatar</span>
						<label for="upload">
							<span class="customUpload">Upload</span>
							<input id="upload" type="file" name="avatar" />
						</label>
					</div>
					<div>
						<input type="submit" value="Sign Up !" />
					</div>
				</form>
			</div>
		</section>
		<!-- +------------- END SIGNUP PAGE -------------+ -->

<?php
	require_once FOOTER;
?>