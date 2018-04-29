<?php
class AccountController
{
	
	public function home()
	{		
		if (!isset($_SESSION["username"]))
		{
			require_once("Views/Account/login.php");
			return;
		}
		
		$currentUser = User::userByName($_SESSION["username"]);
		
		require_once("Views/Account/home.php");
	}
	
	public function login()
	{
		if (isset($_POST["username"], $_POST["password"]))
		{
			if (empty($_POST["username"]) || empty($_POST["password"]))
				$error = "Please complete all fields.";
			
			$auth = new AuthenticationService();
			
			$loginSuccess = $auth->checkLogin($_POST["username"], $_POST["password"]);
			
			if ($loginSuccess)
			{
				$_SESSION["username"] = $_POST["username"];
				return $this->home();
			}
			else
				$error = $auth->error;
		}
		
		require_once("Views/Account/login.php");
	}
	
	public function logout()
	{
		session_destroy();
		
		require_once("Views/Account/login.php");
	}
	
	public function addCard()
	{
		if (!isset($_SESSION["username"]))
		{
			$error = "You must login to add a card.";
			require_once("Views/Account/login.php");
			return;
		}
		
		// require_once("Views/Cards/search.php");
	}
	
	public function addDeck()
	{
		if (!isset($_SESSION["username"]))
		{
			$error = "You must login to add a deck.";
			require_once("Views/Account/login.php");
			return;
		}
		
		// require_once("Views/Cards/search.php");
	}
}
?>