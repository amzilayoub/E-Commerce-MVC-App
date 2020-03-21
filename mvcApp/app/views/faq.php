<?php
	$title = 'FAQ Page';
	$noHomePage = '';
	require_once HEADER;
?>
		<section class="container faq">
			<h1><span>FAQ</span></h1>
			<div class="allQ">
				<?php
					foreach ($data as $value) {
						$post = '<div class="faqItem">';
						$post .= '<h3>' . $value['question'] . '</h3>';
						$post .= '<p class="answer">' . $value['answer'] . '</p>';
						$post .= '</div>';
						echo $post;
					}
				?>
				<div class="faqItem">
					<h3 data-nav="contactAside" class="didntHelp">Didn't Help ?</h3>
				</div>
			</div>
		</section>
<?php
	require_once FOOTER;
?>