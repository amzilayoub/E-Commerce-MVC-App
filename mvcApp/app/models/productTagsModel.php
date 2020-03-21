<?php

class productTagsModel extends model{
	protected static $table = __CLASS__;
	protected static $fillable = ['idProduct', 'tag'];
}