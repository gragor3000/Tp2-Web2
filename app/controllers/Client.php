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
            $_SESSION['MiseurUser'] = $_POST['email'];
            parent::view('MiseurMain');
        }
        elseif($value == -1)
            parent::view('Accueil');
    }

    public static function LoadPastGame()//retourne les stats des parties passée
    {
            parent::model('BD');
            $PastGame = BD::LoadPastGame();
            echo json_encode($PastGame);
    }

    public static function LoadFutureGame()//retourne les stats des parties future
    {
            parent::model('BD');
            $FutureGame = BD::LoadFutureGame();
            echo json_encode($FutureGame);    }

}