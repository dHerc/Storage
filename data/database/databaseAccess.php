<?php declare(strict_types=1);
namespace Storage\Data\Database;

require 'connection.php';

abstract class DatabaseAccess
{
	public static function getBy(string $name, array $conditions = array())
	{
		$connection = self::connect();
		if($connection)
		{
			$query = "SELECT * FROM $name";
			$query.=self::addConditions($conditions);
			$result = ($connection->query($query));
		}
		else
		{
			$result = null;
		}
		return $result;
	}
	public static function add(string $name, array $data = array()): int
	{
		$connection = self::connect();
		if($connection)
		{
			$query = "INSERT INTO $name";
			if(!empty($data))
			{
				$fields = "";
				$values = "";
				foreach($data as $field => $value)
				{
					$fields.= "`$field`,";
					$values.= "'$value',";
				}
				$query.= " (".substr($fields,0,-1).") VALUES (".substr($values,0,-1).")";
			}
			$connection->query($query);
			$id = $connection->insert_id;
		}
		else
		{
			$id = null;
		}
		return $id;
	}
	public static function edit(string $name, array $data, array $conditions = array())
	{
		$connection = self::connect();
		if($connection)
		{
			$query = "UPDATE $name SET";
			$sets = "";
			foreach($data as $field => $value)
			{
				$sets.="`$field`='$value',";
			}
			$query.=substr($sets,0,-1);
			$query.=self::addConditions($conditions);
			$connection->query($query);
			if($connection->connect_errno)
				return false;
			return true;
		}
		else
			return false;
	}
	public static function remove(string $name, array $conditions = array())
	{
		$connection = self::connect();
		if($connection)
		{
			$query = "DELETE FROM $name";
			$query.=self::addConditions($conditions);
			$connection->query($query);
			if($connection->connect_errno)
				return false;
			return true;
		}
		else
			return false;
	}
	private static function addConditions(array $conditions): string
	{
		$query = "";
		$first = true;
		foreach($conditions as $field => $value)
		{
			if($first)
			{
				$query.=" WHERE ";
				$first = false;
			}
			else
			{
				$query.=" AND ";
			}
			$query.="$field='$value'";
		}
		return $query;
	}
	private static function connect()
	{
		$connection = new \mysqli(Connection::$host, Connection::$user, Connection::$password, Connection::$name);
		if ($connection->connect_errno!=0)
		{
			//signal error
		}
		else
		{
			return $connection;
		}
	}
}
