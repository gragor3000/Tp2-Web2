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
    }

    public static function LoadGame()//retourne un string contenant les stas des parties passé et future
    {
        if($_POST["Action"] == "Game")
        {
            parent::model('BD');
            $PastGame = BD::LoadGame();
            $FutureGame = BD::LoadFutureGame();
            $StrGame = "";

            /*
            for($i=0;$i<$PastGame.count();$i++)
            {
                $StrGame = $StrGame ."," . $PastGame[$i][1];
            }
            $StrGame = $StrGame + "//";

            for($ii=0;$ii<3;$ii++) {
                for ($i = 0; $i < $PastGame . count(); $i++) {
                    $StrGame = $StrGame . "," . $FutureGame[$i][$ii];
                }
                $StrGame = $StrGame . ";";
            }*/

            echo json_encode($PastGame);

        }

    }

}