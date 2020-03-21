<?php

class faqModel extends model{
	protected static $table = __CLASS__;
	protected static $fillable = ['question', 'answer'];
	
}