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

    public function index()//ramène a la page d'acceuil
    {
        session_unset();
        session_destroy();
        parent::view('Accueil');
    }

    public static function ShowGain()//appelle le modèle pour les gain
    {
        parent::model('BD');
        $table =  explode(",",$_POST["Gain"]);
        $gain = BD::ShowGain($table[0],$table[1],$table[2]);
        echo $gain;
    }

    public static function Bet()//appelle le modèle pour effectuer la mise
    {
        parent::model('BD');
        $table =  explode(",",$_POST["Bet"]);
        BD::Bet($table[0],$table[1],$table[2],$table[3]);

    }

    public static function Home()//ramène a la page d'Acceuil pour un miseur
    {
        parent::view('MiseurMain');
    }

    public static function LoadMise()//load les mises et les redonne au ajax
    {
        parent::model("Account");
        $table = Account::LoadMise();
        echo json_encode($table);
    }

    public static function DeleteMise()//supprime la mise
    {
        parent::model("BD");
        BD::DeleteMise($_POST["id"]);
    }

    public static function UpdateMise()//modifie la mise
    {
        parent::model("BD");
        $table = explode(",",$_POST["Mise"]);
        BD::UpdateMise($table[0],$table[1],$table[2]);
    }

    public static function ShowOld()
    {
        parent::model("Account");
        $table =  Account::LoadOld();
        echo json_encode($table);
    }
}
