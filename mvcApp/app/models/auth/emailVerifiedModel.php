<?php


class emailVerifiedModel extends model
{
	protected static $table = __CLASS__;
	protected static $fillable = ['idUser','token'];

	
}