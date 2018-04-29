<?php
class Deck
{
	
	public $id;
	public $name;
	public $gameid;
	
	public function __construct($id, $name)
	{
		$this->id = $id;
		$this->name = $name;
		$this->gameid = $gameid;
	}
}