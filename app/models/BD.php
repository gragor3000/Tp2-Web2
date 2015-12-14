
<?php
session_start();

Class BD
{
    public static function Login($Email, $Password)//load la page de la personne si les info rentre sont bonne et charge la page en fontion
    {
        try {
            $pdo = new PDO('sqlite:../app/Models/bd.db');
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
        $Select = "SELECT * FROM Compte WHERE Compte.CompteEmail = :Email AND Compte.ComptePassword = :Password";
        $req = $pdo->prepare($Select);
        $req->bindValue(':Email', $Email);
        $req->bindValue(':Password', md5($Password));
        $req->execute();
        $value = $req->fetchAll();
        if ($value[0][2] == NULL)
            return -1;

        return $value[0][2];
        $pdo = null;


    }

    public static function LoadPastGame()//donne les résultats des games passée
    {
        try {
            $pdo = new PDO('sqlite:../app/Models/bd.db');
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
        $Select = "SELECT * FROM PastScores";
        $req = $pdo->prepare($Select);

        $req->execute();

        return $req->fetchAll(PDO::FETCH_COLUMN);

    }

    public static function LoadFutureGameHost()//donne les Host future
    {
        try {
            $pdo = new PDO('sqlite:../app/Models/bd.db');
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
        $Select = "SELECT * FROM Future";
        $req = $pdo->prepare($Select);

        $req->execute();

        return $req->fetchAll(PDO::FETCH_COLUMN,1);

    }

    public static function LoadFutureGameVisitor()//donne les Visiteurs future
    {
        try {
            $pdo = new PDO('sqlite:../app/Models/bd.db');
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
        $Select = "SELECT * FROM Future";
        $req = $pdo->prepare($Select);

        $req->execute();

        return $req->fetchAll(PDO::FETCH_COLUMN, 2);

    }

    public static function LoadFutureGameLoc()//donne les Loc future
    {
        try {
            $pdo = new PDO('sqlite:../app/Models/bd.db');
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
        $Select = "SELECT * FROM Future";
        $req = $pdo->prepare($Select);

        $req->execute();

        return $req->fetchAll(PDO::FETCH_COLUMN, 3);

    }

    public static function UpdateBD()//exécute les script python pour update la bd
    {
        echo(exec('C:\Python34\python.exe ../app/Models/Espn.py 2>&1'));

    }

    public static function LoadStandings()
    {
        try {
            $pdo = new PDO('sqlite:../app/Models/bd.db');
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
        $Select = "SELECT * FROM Standings";
        $req = $pdo->prepare($Select);

        $req->execute();

        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function LoadFuture()
    {
        try {
            $pdo = new PDO('sqlite:../app/Models/bd.db');
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
        $Select = "SELECT * FROM Future";
        $req = $pdo->prepare($Select);

        $req->execute();

        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function LoadMise()
    {
        try {
            $pdo = new PDO('sqlite:../app/Models/bd.db');
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
        $Select = "SELECT * FROM Future";
        $req = $pdo->prepare($Select);

        $req->execute();

        return $req->fetchAll();
    }

    public static function LoadAPITeams($id)
    {

    }

}
?>