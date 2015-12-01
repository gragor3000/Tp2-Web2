<?php
session_start();
class Home extends Controller
{
	public static function index( $name = '')
	{
		//echo "allo " . $name;
		//$user = $this -> model ('User');
		//$user->name = $name;
		parent::view('home/HTML/Accueil');
	}

	public static function patate ()
	{
		echo "J'aime les patates";
	}

	public function login()
	{
		parent::model('PHP/BD');

		$value = BD::Login($_POST['email'], $_POST['password']);

		if($value == 1) {
			$_SESSION['AdminUser'] = $_POST['email'];
			parent::view('home/HTML/AdminMain');
		}

		else if($value == 0) {
			$_SESSION['ClientUser'] = $_POST['email'];
			parent::view('home/HTML/ClientMain');
		}
	}

}