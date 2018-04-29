<?php
class PagesController
{
	
	public function home()
	{
		require_once('Views/Pages/home.php');
	}

	public function error()
	{
		require_once('Views/Pages/error.php');
	}
}
?>