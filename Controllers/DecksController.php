<?php
class DecksController
{
	
	public function index()
	{
		$decks = Deck::allDecks();
		
		require_once("Views/Decks/index.php");
	}
}
?>