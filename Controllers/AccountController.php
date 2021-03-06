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
	
	public function register()
	{
		if (isset($_POST["username"], $_POST["password"], $_POST["password2"]))
		{
			$username = $_POST["username"];
			$password = $_POST["password"];
			$password2 = $_POST["password2"];
			
			$registerErrors = array();
			
			if (empty($username) || empty($password) || empty($password2))
			{
				$registerErrors[] = "Please complete all fields.";
				require_once("Views/Account/register.php");
				return;
			}
			
			if (strlen($username) > 16)
				$registerErrors[] = "Please enter a username under 17 characters.";
			
			if ($password != $password2)
				$registerErrors[] = "Passwords do not match.";
			
			if (empty($registerErrors))
			{
				$auth = new AuthenticationService();
				
				$registerSuccess = $auth->registerAccount($username, $password);
				
				if ($registerSuccess)
					return $this->login();
				
				$registerErrors[] = $auth->error;
			}
		}
		
		require_once("Views/Account/register.php");
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
		$userDecks = $currentUser->decks();
		
		if (isset($_POST["name"], $_POST["rarity"], $_POST["rating"], $_POST["gameid"]))
		{
			$addErrors = array();
			
			$name = $_POST["name"];
			$rarity = $_POST["rarity"];
			$rating = $_POST["rating"];
			$gameid = $_POST["gameid"];
			if (isset($_POST["deckids"]))
				$deckids = $_POST["deckids"];
			
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
		
			if (isset($deckids))
			{
				// Check if posted deck IDs actually belong to user.
				foreach ($deckids as $deckid)
				{
					$deckFound = false;
					
					foreach ($userDecks as $userDeck)
						if ($userDeck->id == $deckid)
							$deckFound = true;
					
					if (!$deckFound)
						$addErrors[] = "There was an error adding the card to a deck.";
				}
			}
			
			if (empty($addErrors))
			{
				$cardid = $currentUser->addCard($name, $rarity, $rating, $gameid);
				
				if (isset($deckids))
					foreach ($deckids as $deckid)
						$currentUser->addBelongsTo($cardid, $deckid);
				
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
		$userGames = $currentUser->games();
		
		if (isset($_POST["name"], $_POST["gameid"]))
		{
			$addErrors = array();
			
			$name = $_POST["name"];
			$gameid = $_POST["gameid"];
			
			if (strlen($name) > 16 || strlen($name) == 0)
				$addErrors[] = "That deck name is too long or short. 16 characters max.";
			
			// Check if posted game ID actually belongs to user.
			$gameFound = false;
			
			foreach ($userGames as $userGame)
				if ($userGame->id == $gameid)
					$gameFound = true;
			
			if (!$gameFound)
				$addErrors[] = "Please select a game, or make one if you haven't already.";
			
			if (empty($addErrors))
			{
				$currentUser->addDeck($name, $gameid);
				return $this->home();
			}
		}
		
		require_once("Views/Account/addDeck.php");
	}
	
	public function addGame()
	{
		if (!isset($_SESSION["username"]))
		{
			$error = "You must login to add a game.";
			require_once("Views/Account/login.php");
			return;
		}
		
		$currentUser = User::userByName($_SESSION["username"]);
		
		if (isset($_POST["name"], $_POST["fields"]))
		{
			$addErrors = array();
			
			$name = $_POST["name"];
			$fields = $_POST["fields"];
			
			if (strlen($name) > 16 || strlen($name) == 0)
				$addErrors[] = "That game name is too long or short. 16 characters max.";
		
			if (strlen($fields) > 50)
				$addErrors[] = "Fields must not be more than 50 characters.";
			
			if (empty($addErrors))
			{
				$currentUser->addGame($name, $fields);
				return $this->home();
			}
		}
			
		require_once("Views/Account/addGame.php");
	}
}
?>