<?php

class rateModel extends model{

	protected static $table = __CLASS__;
	protected static $fillable = ['idProduct', 'idUser', 'rating'];
	
}