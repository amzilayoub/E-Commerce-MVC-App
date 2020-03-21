<?php

class salesModel extends model{

	protected static $table = __CLASS__;
	protected static $fillable = ['idProduct', 'idBuyer', 'amount'];

}