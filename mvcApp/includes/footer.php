		<!-- +------------- START ERROR MSG -------------+ -->
		<section class="errors">
		</section>
		<!-- +------------- END ERROR MSG -------------+ -->
		<!-- +------------- START LOADING -------------+ -->
		<div class="parentLoading">
			<div class="lds-ring"><div></div><div></div><div></div><div></div></div>
		</div>
		<!-- +------------- END LOADING -------------+ -->

		<!-- +------------- START FOOTER -------------+ -->
		<footer>
			<div class="allPart container">
				<div class="part">
					<h1><span>LET US HELP YOU</span></h1>
					<ul>
						<li>
							<a data-nav="mainBar" class="notSignIn" href="#">Menu</a>
						</li>
						<li>
							<?php
								if (isset($_SESSION['user']['idUser'])) {

									echo '<a href="user">My Account</a>';
								
								} else {

									echo '<a data-nav="authenticate" class="notSignIn" href="#">My Account</a>';

								}
							?>
						</li>
						<li>
						<?php
							if (isset($_SESSION['user']['idUser'])) {

								echo '<a href="myCart">Your Orders</a>';
							
							} else {

								echo '<a data-nav="authenticate" class="notSignIn" href="#">Your Orders</a>';

							}
						?>
						</li>
						<li>
							<a href="product/search/-1">Product On Solde</a>
						</li>
						<li>
							<a href="product/search/">Search</a>
						</li>
						<li>
							<a class="contactUs" data-nav="contactAside" href="#">Contact Us</a>
						</li>
					</ul>
				</div>
				<div class="part">
					<h1><span>NewsLetter</span></h1>
					<p>Enter you email adress for our mailing list to keep your self update</p>
					<form class="newsLetterForm">
						<input type="email" name="email" placeholder="Email Adress..." />
						<input type="submit" value="Subscribe" />
					</form>
				</div>
				<div class="part">
					<h1><span>Tags Clound</span></h1>
					<ul>
						<?php
							for ($i = 0; $i < 6 ; $i++ ) {
								$post = '<li>';
								$post .= '<a href="product/search/' . $_SESSION['tags'][$i] . '">' . ucfirst($_SESSION['tags'][$i]) . '</a>';
								$post .= '</li>';
								echo $post;

							}
						?>
						
					</ul>
				</div>
				<div class="part">
					<h1><span>Download App</span></h1>
					<div class="mobileApp">
						<a href="#">
							<i class="la la-play"></i>
							<span>Get it on Google Play</span>
						</a>
						<a href="#">
							<i class="la la-play"></i>
							<span>Get it on App Store</span>
						</a>
					</div>
				</div>
			</div>
			<div class="info">
				<p>Designed And Developed By <a target="_blank" href="http://www.desa.services"><span>DESA</span></a></p>
			</div>
		</footer>
		<!-- +------------- END FOOTER -------------+ -->
        <!-- jQuery first, then Popper.js -->
        <script src="js/jquery-3.3.1.min.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="js/jquery.nice-select.min.js"></script>
        <script src="js/plugin.js"></script>
        <script src="js/ajax.js"></script>
    </body>
</html>