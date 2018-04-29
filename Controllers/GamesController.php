<?php
class GamesController
{
	
	public function index()
	{
		$games = Game::allGames();
		
		require_once("Views/Games/index.php");
	}
}