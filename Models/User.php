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
	
	public static function userByID(int $id): User
	{
		$db = Database::getInstance();
		
		$stmt = $db->prepare("
			SELECT *
			FROM User
			WHERE userID = :id
		");
		
		$stmt->execute(array("id" => $id));
		
		$user = $stmt->fetch();
		
		return new User($user["userID"], $user["Username"], $user["RegistrationDate"]);
	}
	
	/* public function cards(): array
	{
		$db = Database::getInstance();
		
		$stmt = $db->prepare("
			SELECT *
			FROM Card
			WHERE 
			
	*/
}