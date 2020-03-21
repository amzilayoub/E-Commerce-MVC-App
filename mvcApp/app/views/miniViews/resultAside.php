<?php

for ($i = 0; $i < count($data['product']) ; $i++) {
	if ($i >= 4) {
		break;
	} else {
		$post = '<div class="product">';
		$post .= '<a href="product/show/' . $data['product'][$i]['idProduct'] . '"></a>';
		$post .= '<div>';
		$post .= '<img src="uploaded/productImg/' . $data['product'][$i]['img'] . '" />';
		$post .= '</div>';
		$post .= '<div>';
		$post .= '<h6>' . $data['product'][$i]['name'] . '</h6>';
		$post .= '<h4>' . $data['product'][$i]['price'] . ' $</h4>';
		$post .= '</div>';
		$post .= '</div>';
		echo $post;
	}
}

?>