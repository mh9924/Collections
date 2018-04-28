<?php
class Card
{
	
	public $id;
	public $name;
	public $rarity;
	public $addDate;
	public $rating;
	public $gameID;
	
	public function __construct($id, $name, $rarity, $addDate, $rating, $gameID, $rarityComment, $imageFile)
	{
		$this->id = $id;
		$this->name = $name;
		$this->rarity = $rarity;
		$this->addDate = $addDate;
		$this->rating = $rating;
		$this->gameID = $gameID;
		$this->rarityComment = $rarityComment;
		$this->imageFile = $imageFile;
	}
	
	public static function allCards(): array
	{
		$cards = array();
		$db = Database::getInstance();
		
		$stmt = $db->prepare("
			SELECT *, getRarity(Rating)
			FROM Card;
		");
		
		$stmt->execute();
		
		foreach ($stmt->fetchAll() as $card)
			$cards[] = new Card($card["ID"], $card["Name"], $card["Rarity"], $card["AddDate"], $card["Rating"], $card["GameID"], $card["getRarity(Rating)"], $card["ImageFile"]);
			
		return $cards;
	}
	
	public static function searchCards(string $searchQuery)
	{
		$cards = array();
		$db = Database::getInstance();
		
		$stmt = $db->prepare("
			SELECT *, getRarity(Rating)
			FROM Card
			WHERE Name LIKE :searchQuery
		");
		
		$stmt->execute(array('searchQuery' => "%$searchQuery%"));
		
		foreach ($stmt->fetchAll() as $card)
			$cards[] = new Card($card["ID"], $card["Name"], $card["Rarity"], $card["AddDate"], $card["Rating"], $card["GameID"], $card["getRarity(Rating)"], $card["ImageFile"]);
		
		return $cards;
	}
}