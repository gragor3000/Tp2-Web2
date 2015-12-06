<?php
/**
 * Created by PhpStorm.
 * User: Mic
 * Date: 2015-12-06
 * Time: 13:26
 */
class Admin extends Controller
{
    public static function Account()
    {
        parent::model("Account");

        if($_POST['User'] == "Admin")
            echo Account::Admin();
    }
}