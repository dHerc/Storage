<?php declare(strict_types=1);
namespace Storage\Controll\Users;

require $_SERVER['DOCUMENT_ROOT'].'/data/database/databaseAccess.php';

use Storage\Data\Database\DatabaseAccess as DBAccess;

abstract class ManageUsers
{
	public static function login(string $username, string $password): bool
	{
		$user = DBAccess::getBy("users", array("username" => $_POST['username']))->fetch_assoc();
		if($user)
		{
			$password = $user['password'];
			echo $password;
			if($password&&password_verify($_POST['password'],$password))
				return true;	
			else
				return false;
		}
		else
		{
			return false;
		}
	}
	public static function register(string $username, string $password): bool
	{
		$user = DBAccess::getBy("users", array("username" => $_POST['username']))->fetch_assoc();
		if($user)
			return false;
		$user_id = DBAccess::add("users", 
								 array("username" => $username,
								 "password" => password_hash($password, PASSWORD_DEFAULT)));
		if($user_id === false)
			return false;
		else
			return true;
	}
}