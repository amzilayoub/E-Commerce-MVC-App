<?php


class myCartModel extends model
{
	protected static $table = __CLASS__;
	protected static $fillable = ['idProduct', 'idUser', 'amount'];
}