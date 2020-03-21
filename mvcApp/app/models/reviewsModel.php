<?php

class reviewsModel extends model{
	protected static $table = __CLASS__;
	protected static $fillable =['idProduct', 'idUser', 'review'];

}