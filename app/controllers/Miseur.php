<?php
/**
 * Created by PhpStorm.
 * User: Mic
 * Date: 2015-12-06
 * Time: 13:27
 */
session_start();
Class Miseur extends Controller
{
    public static function AddToken()//appelle la méthode dans le model pour ajouter dans la bd
    {
        parent::model('Account');
        Account::AddToken($_POST["Token"]);
    }

    public static function ShowToken()//appelle la méthode du model qui va chercher les token dans la bd
    {
        parent::model('Account');
        $Token = Account::ShowToken();
        echo json_encode(intval($Token[0][0]));
    }

    public static function Mise()//change la page a celle des mises du user en cours
    {
        parent::view('MiseurMise');
    }

    public function index()
    {
        session_unset();
        session_destroy();
        parent::view('Accueil');
    }
}
