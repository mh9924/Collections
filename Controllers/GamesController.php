<?php
class GamesController
{
	
	public function index()
	{
		$games = UserGame::allUserGames();
		
		require_once("Views/Games/index.php");
	}
}