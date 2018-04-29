<?php
function call($controller, $action)
{
	require_once('Controllers/' . $controller . 'Controller.php');

	switch($controller)
	{
		case 'Pages':
			$controller = new PagesController();
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
		
		case 'Users':
			require_once('Models/User.php');
			require_once('Models/Game.php');
			$controller = new UserController();
			break;
	}

	$controller->{$action}();
}

$controllers = array('Pages' => ['home', 'error'],
						'Cards' => ['index', 'search'],
						'Games' => ['index', 'byUser'],
						'Users' => ['viewProfile']);

if (array_key_exists($controller, $controllers))
	if (in_array($action, $controllers[$controller])) 
		call($controller, $action);
	else 
		call('Pages', 'error');
else
	call('Pages', 'error');
?>