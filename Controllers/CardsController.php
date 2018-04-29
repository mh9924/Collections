<?php
class CardsController
{
	
	public function index()
	{
		$newestCard = Card::newestCard();
		$oldestCard = Card::oldestCard();
		$rarityCounts = Card::rarityCounts(2);
		$cards = Card::allCards();
		
		require_once("Views/Cards/index.php");
	}
	
	public function search()
	{
		if (!isset($_GET["searchQuery"]))
			return call("Pages", "error");
		
		$cards = Card::searchCards($_GET["searchQuery"]);
		
		require_once("Views/Cards/search.php");
	}
}
?>