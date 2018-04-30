<?php
class Deck
{
	
	public $id;
	public $name;
	public $gameid;
	public $numCards;
	
	public function __construct($id, $name, $gameid, $numCards)
	{
		$this->id = $id;
		$this->name = $name;
		$this->gameid = $gameid;
		$this->numCards = $numCards;
	}
	
	public static function allDecks(): array
	{
		$decks = array();
		$db = Database::getInstance();
		
		$stmt = $db->prepare("
			SELECT * 
			FROM Deck 
		");
		
		$stmt->execute();
		
		foreach ($stmt->fetchAll() as $deck)
			$decks[] = new Deck($deck["ID"], $deck["Name"], $deck["GameID"], $deck["NumOfCards"]);
			
		return $decks;
	}
	
	public function game(): Game
	{
		$db = Database::getInstance();
		
		$stmt = $db->prepare("
			SELECT *
			FROM Game
			WHERE gameID = :gameID
		");
		
		$stmt->execute(array("gameID" => $this->gameid));
		
		$gameInfo = $stmt->fetch();
		
		return new Game($gameInfo["gameID"], $gameInfo["Name"], $gameInfo["Fields"], $gameInfo["UserID"], $this->user()->username);
	}	
	
	public function user(): User
	{
		$db = Database::getInstance();
		
		$stmt = $db->prepare("
			SELECT User.userID, Username, RegistrationDate
			FROM User
			INNER JOIN Game on Game.UserID = User.UserID
			INNER JOIN Deck on Deck.GameID = Game.gameID
			WHERE Deck.ID = :id
		");
		
		$stmt->execute(array("id" => $this->id));
		
		$userInfo = $stmt->fetch();
		
		return new User($userInfo["userID"], $userInfo["Username"], $userInfo["RegistrationDate"]);
	}
	
}
?>