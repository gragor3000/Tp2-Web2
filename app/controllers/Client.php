<?php
/**
 * Created by PhpStorm.
 * User: Mic
 * Date: 2015-12-06
 * Time: 13:26
 */
session_start();
class Client extends Controller
{
    public static function index()
    {
        parent::view('Accueil');
    }

    public function login()
    {
        parent::model('BD');

        $value = BD::Login($_POST['email'], $_POST['password']);

        if($value == 1) {
            $_SESSION['AdminUser'] = $_POST['email'];
            parent::view('AdminMain');
        }

        else if($value == 0) {
            $_SESSION['ClientUser'] = $_POST['email'];
            parent::view('ClientMain');
        }
    }

}