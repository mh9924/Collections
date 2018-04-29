<?php
function call($controller, $action)
{
	require_once('Controllers/' . $controller . 'Controller.php');

	switch($controller)
	{
		case 'Account':
			require_once('Models/AuthenticationService.php');
			require_once('Models/User.php');
			require_once('Models/Card.php');
			require_once('Models/Deck.php');
			$controller = new AccountController();
			break;
		
		case 'Cards':
			require_once('Models/User.php');
			require_once('Models/Card.php');
			$controller = new CardsController();
			break;

		case 'Games':
			require_once('Models/Game.php');
			$controller = new GamesController();
			break;
			
		case 'Pages':
			$controller = new PagesController();
			break;
		
		case 'Users':
			require_once('Models/User.php');
			require_once('Models/Game.php');
			$controller = new UserController();
			break;
	}

	$controller->{$action}();
}

$controllers = array('Account' => ['home', 'login', 'logout', 'addCard', 'addDeck'],
						'Cards' => ['index', 'search'],
						'Games' => ['index', 'byUser'],
						'Pages' => ['home', 'error'],
						'Users' => ['viewProfile']);

if (array_key_exists($controller, $controllers))
	if (in_array($action, $controllers[$controller])) 
		call($controller, $action);
	else 
		call('Pages', 'error');
else
	call('Pages', 'error');
?>