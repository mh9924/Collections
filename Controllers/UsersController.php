<?php
class UserController
{
	
	public function viewProfile()
	{
		if (!isset($_GET["userID"]))
			return call("Pages", "error");
		
		$user = User::userByID($_GET["userID"]);
		
		if (!$user)
			return call("Pages", "error");
		
		$games = $user->games();
		
		require_once("Views/Users/profile.php");
	}
}
?>