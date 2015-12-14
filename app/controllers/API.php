<?php
/**
 * Created by PhpStorm.
 * User: Mic
 * Date: 2015-12-14
 * Time: 15:51
 */
Class API extends Controller
{
    public function Index()
    {
        parent::view('APIVIEW');
    }

    public static function Teams()//envoi tous les standings au ajax
    {
        parent::model('BD');
        $table = BD::LoadStandings();
        echo json_encode($table);
    }

    public function LoadAPIFuture()//envoi toute les games futures au ajax
    {
        parent::model('BD');
        $table = BD::LoadFuture();
        echo json_encode($table);
    }

    public function Games($id=-1)//donne soit toute les parties ou
    {
        parent::model('BD');

        if($id <= 0)
        {
            $table =  BD::LoadAPIGames();
            echo json_encode($table);
        }
        else {
            $table = BD::LoadAPIGame($id);
            echo json_encode($table);
        }
    }
}