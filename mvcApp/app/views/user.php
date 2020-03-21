<?php
	$title = 'User : ' . $_SESSION['user']['username'];
	$noHomePage = '';
	require_once HEADER;
?>

		<!-- +------------- START USER INFORMATION -------------+ -->
		<section class="loadingThisSection container user">
			<div class="userProfil marginTopBottom">
				<div class="profilPic">
					<?php 
						if (isset($_SESSION['user']['avatar']) && !empty($_SESSION['user']['avatar'])) {

							echo '<img src="uploaded/avatars/' . $_SESSION['user']['avatar'] . '" />';
						
						} else {
							echo '<i style="font-size:200px;transform: translateX(7px);" class="la la-user"></i>';
						}

					?>
				</div>
				<h1><?php echo $_SESSION['user']['username']; ?></h1>
				<div class="btn">
					<a href="user/editProfile">Edit Profile &amp; Settings</a>
				</div>
				<p><?php echo $_SESSION['user']['aboutMe']; ?> </p>
			</div>
			<div class="allItems">
				<div class="item">
					<h1><span>History</span></h1>
					<table>
						<tr>
							<th>ID</th>
							<th>Name</th>
							<th>Quantite</th>
							<th>Date</th>
							<th>Manupilation</th>
						</tr>
						<?php
							if (count($data['product']) > 0) {
								foreach ($data['product'] as $value) {
									$post = '<tr>';
									$post .= '<td>' . $value['idProduct'] . '</td>';
									$post .= '<td>' . $value['name'] . '</td>';
									$post .= '<td>' . $value['amount'] . '</td>';
									$post .= '<td>' . $value['created_at'] . '</td>';
									$post .= '<td>';
									$post .= '<a href="sales/removeFromSales/' . $value['idProduct'] . '">Delete</a>';
									$post .= '<a href="product/show/' . $value['idProduct'] . '">Info</a>';
									$post .= '</td>';
									$post .= '</tr>';
									echo $post;
								}
							} else {
								echo '<tr><td class="zeroSales" colspan="5">You\'re Not Buying Anything !</td></td>';
							}
						?>
					</table>
				</div>
			</div>
		</section>
		<!-- +------------- END USER INFORMATION -------------+ -->
<?php
	require_once FOOTER;
?>