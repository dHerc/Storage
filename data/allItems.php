<?php declare(strict_types=1);
namespace Storage\Data;
require 'item.php';
use Storage\Data\Item as Item;
class AllItems
{
	private $items = array();
	
	public function getItem(int $id)
	{
		return $this->items[$id];
	}
	public function getItems()
	{
		return $this->items;
	}
	public function updateItems($items)
	{
		$this->items = $items;
	}
	public function editItem(Item $item)
	{
		$this->items[$item->id] = $item;
	}
	public function removeItem(int $id)
	{
		unset($this->items[$id]);
	}
}