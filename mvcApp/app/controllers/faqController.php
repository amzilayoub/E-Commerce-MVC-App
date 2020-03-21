<?php

class faqController extends controller{
	public function home(){
		$faq = faqModel::select();
		return $this->view('faq', $faq);
	}
}