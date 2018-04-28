<?php
class UserGame
{
	
	public $userID;
	public $gameID;
	public $name;
	public $fields;
	public $username;
	public $registrationDate;
	
	public function __construct($userID, $gameID, $name, $fields, $username, $registrationDate)
	{
		$this->userID = $userID;
		$this->gameID = $gameID;
		$this->name = $name;
		$this->fields = $fields;
		$this->username = $username;
		$this->registrationDate = $registrationDate;
	}
	
	public static function allUserGames(): array
	{
		$ugames = array();
		$db = Database::getInstance();
		
		$stmt = $db->prepare("
			SELECT * 
			FROM Game 
			NATURAL JOIN User
		");
		
		$stmt->execute();
		
		foreach ($stmt->fetchAll() as $ugame)
			$ugames[] = new UserGame($ugame["UserID"], $ugame["gameID"], $ugame["Name"], $ugame["Fields"], $ugame["Username"], $ugame["RegistrationDate"]);
			
		return $ugames;
	}
	
	public function numCards(): int
	{
		$db = Database::getInstance();
		
		$stmt = $db->prepare("
			SELECT COUNT(GameID)
			FROM Card 
			WHERE Card.GameID = :id
		");
		
		$stmt->execute(array("id" => $this->gameID));
		
		return $stmt->fetch()[0];
	}
}