<?php declare(strict_types=1);
namespace Storage\Data;

class Item
{
	public int $id;
	public string $title;
	public string $description;
	public int $status;
	
	public function __construct(
	int $id,
	string $title,
	string $description,
	int $status)
	{
		$this->id = $id;
		$this->title = $title;
		$this->description = $description;
		$this->status = $status;
	}
}