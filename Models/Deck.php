<?php
class Deck
{
	
	public $id;
	public $name;
	public $gameid;
	
	public function __construct($id, $name, $gameid)
	{
		$this->id = $id;
		$this->name = $name;
		$this->gameid = $gameid;
	}
	
	public static function allDecks(): array
	{
		$decks = array();
		$db = Database::getInstance();
		
		$stmt = $db->prepare("
			SELECT * 
			FROM Deck 
			NATURAL JOIN User
		");
		
		$stmt->execute();
		
		foreach ($stmt->fetchAll() as $deck)
			$decks[] = new Deck($deck["ID"], $deck["Name"], $deck["GameID"]);
			
		return $decks;
	}
}
?>