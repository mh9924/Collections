<?php
class Game
{
	
	public $id;
	public $name;
	public $fields;
	public $userID;
	
	public function __construct($id, $name, $fields, $userID)
	{
		$this->id = $id;
		$this->name = $name;
		$this->fields = $fields;
		$this->userID = $userID;
	}
	
	public static function allGames(): array
	{
		$games = array();
		$db = Database::getInstance();
		
		$stmt = $db->prepare("
			SELECT *
			FROM Game;
		");
		
		$stmt->execute();
		
		foreach ($stmt->fetchAll() as $game)
			$games[] = new Game($game["gameID"], $game["Name"], $game["Fields"], $game["UserID"]);
			
		return $games;
	}
	
	public static function searchGames(string $searchQuery): array
	{
		$games = array();
		$db = Database::getInstance();
		
		$stmt = $db->prepare("
			SELECT *
			FROM Game
			WHERE Name LIKE :searchQuery
		");
		
		$stmt->execute(array("searchQuery" => "%$searchQuery%"));
		
		foreach ($stmt->fetchAll() as $game)
			$games[] = new Game($game["gameID"], $game["Name"], $game["Fields"], $game["UserID"]);
		
		return $games;
	}
	
	public function numCards(): int
	{
		$db = Database::getInstance();
		
		$stmt = $db->prepare("
			SELECT COUNT(GameID)
			FROM Card 
			WHERE Card.GameID = :id
		");
		
		$stmt->execute(array("id" => $this->id));
		
		return $stmt->fetch()[0];
	}
}