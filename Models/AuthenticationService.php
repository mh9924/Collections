<?php
class AuthenticationService
{
	
	public $error;
	
	public function registerAccount(string $username, string $password)
	{
		$db = Database::getInstance();
		
		$usernameExistsStmt = $db->prepare("
			SELECT *
			FROM User
			WHERE Username = :username
		");
		
		$usernameExistsStmt->execute(array("username" => $username));
		
		if ($usernameExistsStmt->rowCount() == 1)
		{
			$this->error = "Username is already in use";
			return false;
		}
		
		$registerAccStmt = $db->prepare("
			INSERT INTO User
			(Username, Password, RegistrationDate)
			VALUES
			(:username, :password, :registrationDate)
		");
		
		$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
		
		$registerAccStmt->execute(array("username" => $username, "password" => $hashedPassword, "registrationDate" => time()));
		
		return true;
	}
	
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
		
		if (!password_verify($password, $dbPassword))
		{
			$this->error = "Invalid password";
			return false;
		}
		
		return true;
	}
}