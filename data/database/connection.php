<?php
namespace Storage\Data\Database;
abstract class Connection
{
	public static $host;
	public static $user;
	public static $password;
	public static $name;
}
$url = parse_url(getenv("CLEARDB_DATABASE_URL"));
Connection::$host = $url["host"];
Connection::$user = $url["user"];
Connection::$password = $url["pass"];
Connection::$name = substr($url["path"], 1);
