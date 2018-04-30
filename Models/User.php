<?php
class User
{
	
	public $id;
	public $username;
	public $registrationDate;
	
	public function __construct($id, $username, $registrationDate)
	{
		$this->id = $id;
		$this->username = $username;
		$this->registrationDate = $registrationDate;
	}
	
	public static function userByID(int $id)
	{
		$db = Database::getInstance();
		
		$stmt = $db->prepare("
			SELECT *
			FROM User
			WHERE userID = :id
		");
		
		$stmt->execute(array("id" => $id));
		
		$user = $stmt->fetch();
		
		if ($stmt->rowCount() == 1)
			return new User($user["userID"], $user["Username"], $user["RegistrationDate"]);
		else
			return false;
	}
	
	public static function userByName(string $username)
	{
		$db = Database::getInstance();
		
		$stmt = $db->prepare("
			SELECT *
			FROM User
			WHERE Username = :username
		");
		
		$stmt->execute(array("username" => $username));
		
		$user = $stmt->fetch();
		
		if ($stmt->rowCount() == 1)
			return new User($user["userID"], $user["Username"], $user["RegistrationDate"]);
		else
			return false;
	}
	
	public function games(): array
	{
		$games = array();
		$db = Database::getInstance();
		
		$stmt = $db->prepare("
			SELECT *
			FROM Game
			WHERE UserID = :id
		");
		
		$stmt->execute(array("id" => $this->id));
		
		foreach ($stmt->fetchAll() as $game)
			$games[] = new Game($game["gameID"], $game["Name"], $game["Fields"], $this->id, $this->username);
			
		return $games;		
	}
	
	public function decks(): array
	{
		$decks = array();
		$db = Database::getInstance();
		
		$stmt = $db->prepare("
			SELECT ID, Deck.Name, Deck.GameID, NumOfCards
			FROM Deck
			JOIN Game ON Deck.GameID = Game.gameID
			JOIN User on Game.UserID = User.userID
			WHERE User.userID = :id
		");
		
		$stmt->execute(array("id" => $this->id));
		
		foreach ($stmt->fetchAll() as $deck)
			$decks[] = new Deck($deck["ID"], $deck["Name"], $deck["GameID"], $deck["NumOfCards"]);
			
		return $decks;
	}
	
	public function cards(): array
	{
		$cards = array();
		$db = Database::getInstance();
		
		$stmt = $db->prepare("
			SELECT Card.ID, Card.Name, Card.Rarity, Card.AddDate, Card.Rating, Card.GameID, Card.ImageFile
			FROM Card
			JOIN Game ON Card.GameID = Game.gameID
			JOIN User on Game.UserID = User.userID
			WHERE User.userID = :id
		");
		
		$stmt->execute(array("id" => $this->id));
		
		foreach ($stmt->fetchAll() as $card)
			$cards[] = new Card($card["ID"], $card["Name"], $card["AddDate"], $card["Rarity"], $card["Rating"], $card["GameID"], $card["ImageFile"]);
			
		return $cards;
	}
	
	public function addCard(string $name, int $rarity, int $rating, int $gameID): int
	{
		$db = Database::getInstance();
		
		$stmt = $db->prepare("
			INSERT INTO Card
			(Name, Rarity, AddDate, Rating, GameID)
			VALUES (:name, :rarity, :addDate, :rating, :gameID)
		");
		
		$stmt->execute(array("name" => $name, "rarity" => $rarity, "addDate" => time(), "rating" => $rating, "gameID" => $gameID));
		
		return $db->lastInsertId();
	}
	
	public function addDeck(string $name, int $gameID): int
	{
		$db = Database::getInstance();
		
		$stmt = $db->prepare("
			INSERT INTO Deck
			(Name, GameID, NumOfCards)
			VALUES (:name, :gameID, 0)
		");
		
		$stmt->execute(array("name" => $name, "gameID" => $gameID));
		
		return $db->lastInsertId();
	}
	
	public function addGame(string $name, string $fields): int
	{
		$db = Database::getInstance();
		
		$stmt = $db->prepare("
			INSERT INTO Game
			(Name, Fields, UserID)
			VALUES (:name, :fields, :id)
		");
		
		$stmt->execute(array("name" => $name, "fields" => $fields, "id" => $this->id));
		
		return $db->lastInsertId();
	}
	
	public function addBelongsTo(int $cardID, int $deckID): int
	{
		$db = Database::getInstance();
		
		$stmt = $db->prepare("
			INSERT INTO Belongs_To
			(CardID, DeckID)
			VALUES (:cardID, :deckID)
		");
		
		$stmt->execute(array("cardID" => $cardID, "deckID" => $deckID));
		
		return $db->lastInsertId();
	}
}