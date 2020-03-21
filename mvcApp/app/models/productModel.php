<?php

class productModel extends model{

	protected static $table = __CLASS__;
	protected static $fillable = ['idUser','idSize','name','description','price','sex','season','amount','brand'];
}