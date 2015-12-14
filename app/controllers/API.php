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

    public static function LoadAPITeam()//envoi tous les standings au ajax
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

    public function LoadAPIMise()//envoi toutes les mises au ajax
    {
        parent::model('BD');
        echo json_encode(BD::LoadMise());
    }

    public function Teams($id)
    {
        parent::model('BD');

    }
}