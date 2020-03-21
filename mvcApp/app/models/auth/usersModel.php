<?php


class usersModel extends model
{
	protected static $table = __CLASS__;
	protected static $fillable = ['username','email','passwordUser','birthday','adresse','zipCode','aboutMe','avatar'];
}