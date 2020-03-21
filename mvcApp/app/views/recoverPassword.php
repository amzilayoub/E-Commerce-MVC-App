<?php
	$title = 'Recover Your Password';
	$noHomePage = '';
	require_once HEADER;
?>
		<!-- +------------- START SIGNUP PAGE -------------+ -->
		<section class="loadingThisSection changePassForget addDiscount addProduct signUp container marginTopBottom">
			<h1><span>Change Password</span></h1>
			<div class="form">
				<form method="POST" action="auth/recoverPass">
					<div>
						<input placeholder="New Password" type="password" name="password" />
					</div>
					<div>
						<input placeholder="Type The New Password Again" type="password" name="passwordAgain" />
					</div>
					<div>
						<input type="submit" value="Change Password" />
					</div>
				</form>
			</div>
		</section>
		<!-- +------------- END SIGNUP PAGE -------------+ -->
<?php
	require_once FOOTER;
?>