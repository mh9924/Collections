<?php
class Game
{
	
	public $id;
	public $name;
	public $fields;
	public $userID;
	public $username;
	
	public function __construct($id, $name, $fields, $userID, $username)
	{
		$this->id = $id;
		$this->name = $name;
		$this->fields = $fields;
		$this->userID = $userID;
		$this->username = $username;
	}
	
	public static function allGames(): array
	{
		$games = array();
		$db = Database::getInstance();
		
		$stmt = $db->prepare("
			SELECT * 
			FROM Game 
			NATURAL JOIN User
		");
		
		$stmt->execute();
		
		foreach ($stmt->fetchAll() as $game)
			$games[] = new Game($game["gameID"], $game["Name"], $game["Fields"], $game["UserID"], $game["Username"]);
			
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
			$games[] = new Game($game["gameID"], $game["Name"], $game["Fields"], $game["UserID"], $game["Username"]);
		
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
?>