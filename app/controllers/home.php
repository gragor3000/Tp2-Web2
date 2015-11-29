<?php

class Home extends Controller
{
	public static function index( $name = '')
	{
		//echo "allo " . $name;
		//$user = $this -> model ('User');
		//$user->name = $name;
		parent::view('home/HTML/Accueil', ['name' => $name]);
	}

	public static function patate ()
	{
		echo "J'aime les patates";
	}

	public static function login()
	{
		parent::model('/PHP/BD');
		/*include_once("C:/wamp/www/TP2 Website/app/models/PHP/BD.php");
		Login($_POST['email'], $_POST['password']);*/
	}

}