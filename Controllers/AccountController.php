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
			{
				$error = "Please complete all fields.";
				require_once("Views/Account/login.php");
				return;
			}
			
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
		
		$currentUser = User::userByName($_SESSION["username"]);
		$userGames = $currentUser->games();
		
		if (isset($_POST["name"], $_POST["rarity"], $_POST["rating"], $_POST["gameid"]))
		{
			$addErrors = array();
			
			$name = $_POST["name"];
			$rarity = $_POST["rarity"];
			$rating = $_POST["rating"];
			$gameid = $_POST["gameid"];
			
			if (strlen($name) > 50 || strlen($name) == 0)
				$addErrors[] = "That card name is too long or short. 50 characters max.";
			
			if (!is_numeric($rarity) || !is_numeric($rating) || $rarity < 1 || $rarity > 4 || $rating < 1 || $rating > 10)
				$addErrors[] = "Please choose a rarity/rating.";
			
			// Check if posted game ID actually belongs to user.
			$gameFound = false;
			
			foreach ($userGames as $userGame)
				if ($userGame->id == $gameid)
					$gameFound = true;
			
			if (!$gameFound)
				$addErrors[] = "Please select a game, or make one if you haven't already.";
			
			if (empty($addErrors))
			{
				$currentUser->addCard($name, $rarity, $rating, $gameid);
				return $this->home();
			}
		}
		
		require_once("Views/Account/addCard.php");
	}
	
	public function addDeck()
	{
		if (!isset($_SESSION["username"]))
		{
			$error = "You must login to add a deck.";
			require_once("Views/Account/login.php");
			return;
		}
		
		$currentUser = User::userByName($_SESSION["username"]);
		
		// require_once("Views/Cards/search.php");
	}
}
?>