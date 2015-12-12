<?php
/**
 * Created by PhpStorm.
 * User: Mic
 * Date: 2015-12-06
 * Time: 13:26
 */
class Admin extends Controller
{
    public static function Account()//renvoi au ajax les comptes
    {
        parent::model("Account");
        $data = Account::Admin();
        echo json_encode($data);
    }

    public static function  AddAccount()//envoi a la bd les données a ajoutés
    {
        parent::model("Account");
        $str = explode(",",$_POST["Add"]);
        Account::AddAccount($str[0],$str[1],$str[2]);
    }

    public static function DeleteAccount()//supprime le compte donné
    {
        parent::model("Account");
        Account::DeleteAccount($_POST["Delete"]);
    }

    public static function ModifyAccount()//modifie le compte donné
    {
        parent::model("Account");
        $str = explode(",",$_POST["Modify"]);
        Account::ModifyAccount($str[0],$str[1],$str[2],$str[3]);
    }
}