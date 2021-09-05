<?php declare(strict_types=1);
namespace Storage\Data\Database;
require 'connection.php';
abstract class DatabaseAccess
{
	public static function getItems()
	{
		$connection = DatabaseAccess::connect();
		if($connection)
			$items = $connection->query("SELECT * FROM items");
		else
			$items = null;
		return $items;
	}
	public static function addItem(
	string $title,
	string $description,
	int $status): int
	{
		$connection = DatabaseAccess::connect();
		if($connection)
		{
			$connection->query("INSERT INTO `items` (`title`, `desc`, `status`) VALUES ('$title', '$description', '$status')");
			$id = $connection->insert_id;
		}
		else
			$id = null;
		return $id;
	}
	public static function editItem(
	int $id,
	string $title,
	string $description,
	int $status
	)
	{
		$connection = DatabaseAccess::connect();
		if($connection)
		{
			$connection->query("UPDATE `items` SET".
			((strlen($title)>0)?"`title` = '$title',":"").
			((strlen($description)>0)?"`desc` = '$description',":"").
			"`status` = '$status'".
			"WHERE `items`.`id` = $id");
			if($connection->connect_errno)
				return false;
			return true;
		}
		else
			return false;
	}
	public static function removeItem(int $id)
	{
		$connection = DatabaseAccess::connect();
		if($connection)
		{
			$connection->query("DELETE FROM `items` WHERE `items`.`id` = $id");
			if($connection->connect_errno)
				return false;
			return true;
		}
		else
			return false;
	}
	public static function getUser(string $username)
	{
		$connection = DatabaseAccess::connect();
		if($connection)
			$user = $connection->query("SELECT * FROM users WHERE `username` = '$username'")->fetch_assoc();
		else
			$user = null;
		return $user;
	}
	private static function connect()
	{
		$polaczenie = new \mysqli(Connection::$host, Connection::$user, Connection::$password, Connection::$name);
		if ($polaczenie->connect_errno!=0)
		{
			//signal error
		}
		else
		{
			return $polaczenie;
		}
	}
}
