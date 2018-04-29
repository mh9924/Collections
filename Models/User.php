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
}