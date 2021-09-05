<?php declare(strict_types=1);
namespace Storage\Data;
abstract class Status
{
	private static $status_names = array(
	"w magazynie",
	"zamówiony",
	"spakowany",
	"w dostawie",
	"dostarczony");
	public static function getStatusName(int $id): string
	{
		return self::$status_names[$id];
	}
	public static function getAllStatuses()
	{
		return self::$status_names;
	}
}