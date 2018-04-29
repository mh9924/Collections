<?php
class Card
{
	
	public $id;
	public $name;
	public $rarity;
	public $addDate;
	public $rating;
	public $gameID;
	
	public function __construct($id, $name, $addDate, $rarity=0, $rating=0, $gameID=0, $imageFile="")
	{
		$this->id = $id;
		$this->name = $name;
		$this->addDate = $addDate;
		$this->rarity = $rarity;
		$this->rating = $rating;
		$this->gameID = $gameID;
		$this->imageFile = $imageFile;
	}
	
	public static function allCards(): array
	{
		$cards = array();
		$db = Database::getInstance();
		
		$stmt = $db->prepare("
			SELECT *
			FROM Card;
		");
		
		$stmt->execute();
		
		foreach ($stmt->fetchAll() as $card)
			$cards[] = new Card($card["ID"], $card["Name"], $card["AddDate"], $card["Rarity"], $card["Rating"], $card["GameID"], $card["ImageFile"]);
			
		return $cards;
	}
	
	public static function newestCard(): Card
	{
		$db = Database::getInstance();
		
		$stmt = $db->prepare("CALL getNewest()");
		
		$stmt->execute();
		
		$card = $stmt->fetch();
		
		return new Card(0, $card["Name"], $card["AddDate"]);
	}
	
	public static function oldestCard(): Card
	{
		$db = Database::getInstance();
		
		$stmt = $db->prepare("
			SELECT Name, AddDate
			FROM Card
			ORDER BY AddDate ASC
			LIMIT 1
		");
		
		$stmt->execute();
		
		$card = $stmt->fetch();
		
		return new Card(0, $card["Name"], $card["AddDate"]);
	}
	
	public static function searchCards(string $searchQuery)
	{
		$cards = array();
		$db = Database::getInstance();
		
		$stmt = $db->prepare("
			SELECT *
			FROM Card
			WHERE Name LIKE :searchQuery
		");
		
		$stmt->execute(array("searchQuery" => "%$searchQuery%"));
		
		foreach ($stmt->fetchAll() as $card)
			$cards[] = new Card($card["ID"], $card["Name"], $card["AddDate"], $card["Rarity"], $card["Rating"], $card["GameID"], $card["ImageFile"]);
		
		return $cards;
	}
	
	public function rarityDenotation()
	{
		$db = Database::getInstance();
		
		$stmt = $db->prepare("SELECT getRarity(:rarity)");
		
		$stmt->execute(array("rarity" => $this->rarity));
		
		return $stmt->fetch()[0];
	}
	
	public function tierDenotation()
	{
		$db = Database::getInstance();
		
		$stmt = $db->prepare("SELECT tierList(:rating)");
		
		$stmt->execute(array("rating" => $this->rating));
		
		return $stmt->fetch()[0];
	}
	
}