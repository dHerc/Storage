<?php declare(strict_types=1);
namespace Storage\Controll;
require $_SERVER['DOCUMENT_ROOT'].'/data/allItems.php';
require $_SERVER['DOCUMENT_ROOT'].'/data/database/databaseAccess.php';
use Storage\Data\AllItems as Items;
use Storage\Data\Database\DatabaseAccess as DBAccess;
use Storage\Data\Item as Item;
class ManageItems
{
	private Items $items;
	public function __construct(Items $items)
	{
		$this->items = $items;
	}
	public function getItem(int $id)
	{
		return $this->items->getItem($id);
	}
	public function getItems()
	{
		return $this->items->getItems();
	}
	public function updateItems(): void
	{
		$new_items = DBAccess::getItems();
		if($new_items)
		{
			$items = array();
			foreach($new_items as $item)
			{
				$items[intval($item["id"])] = new Item(intval($item["id"]),$item["title"],$item["desc"],intval($item["status"]));
			}
		}
		$this->items->updateItems($items);
	}
	public function addItem(
	string $title,
	string $description,
	int $status): bool
	{
		$id = DBAccess::addItem($title,$description,$status);
		if($id)
			$this->items->editItem(new Item($id,$title,$description,$status));
		else
			return false;
		return true;
	}
	public function editItem(
	int $id,
	string $title,
	string $description,
	int $status): bool
	{
		$success = DBAccess::editItem($id,$title,$description,$status);
		if($success)
			$this->items->editItem(new Item($id,$title,$description,$status));
		else
			return false;
		return true;
	}
	public function removeItem(int $id): bool
	{
		$success = DBAccess::removeItem($id);
		if($success)
			$this->items->removeItem($id);
		else
			return false;
		return true;
	}
}