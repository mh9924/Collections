<?php
class AuthenticationService
{
	
	public $error;
	
	public function checkLogin(string $username, string $password)
	{
		
		$db = Database::getInstance();
		
		$stmt = $db->prepare("
			SELECT Password
			FROM User
			WHERE Username = :username
		");
		
		$stmt->execute(array("username" => $username));
		
		if ($stmt->rowCount() == 0)
		{
			$this->error = "Username does not exist";
			return false;
		}
		
		$dbPassword = $stmt->fetch()[0];
		
		if (!password_verify($password, $dbPassword)
		{
			$this->error = "Invalid password";
			return false;
		}
		
		return true;
	}
}