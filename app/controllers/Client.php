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

        if ($value == 1) {
            $_SESSION['AdminUser'] = $_POST['email'];
            parent::view('AdminMain');
        } else if ($value == 0) {
            $_SESSION['MiseurUser'] = $_POST['email'];
            parent::view('MiseurMain');
        } elseif ($value == -1)
            parent::view('Accueil');
    }

    public static function LoadPastGame()//retourne les stats des parties passée
    {
        parent::model('BD');
        $PastGame = BD::LoadPastGame();
        echo json_encode($PastGame);
    }

    public static function LoadFutureGameHost()//retourne les host des parties futures
    {
        parent::model('BD');
        $FutureGame = BD::LoadFutureGamehost();
        echo json_encode($FutureGame);
    }

    public static function LoadFutureGameVisitor()//retourne les visiteurs des parties future
    {
        parent::model('BD');
        $FutureGame = BD::LoadFutureGameVisitor();
        echo json_encode($FutureGame);
    }

    public static function LoadFutureGameLoc()//retourne les locations des parties future
    {
        parent::model('BD');
        $FutureGame = BD::LoadFutureGameLoc();
        echo json_encode($FutureGame);
    }

}