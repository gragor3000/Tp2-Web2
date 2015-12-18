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

        return $req->fetchAll(PDO::FETCH_COLUMN, 1);

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


    public static function LoadAPIGames()//donnes toutes les mises
    {
        try {
            $pdo = new PDO('sqlite:../app/Models/bd.db');
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
        $Select = "SELECT * FROM Mise";
        $req = $pdo->prepare($Select);

        $req->execute();

        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function LoadAPIGame($id)//donne les mise sur la partie donnée
    {
        try {
            $pdo = new PDO('sqlite:../app/Models/bd.db');
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
        $Select = "SELECT * FROM Mise WHERE Game = :ID";
        $req = $pdo->prepare($Select);
        $req->bindValue(':ID', $id);
        $req->execute();

        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function ShowGain($id, $team, $token)//donne le pourcentage de gain
    {
        try {
            $pdo = new PDO('sqlite:../app/Models/bd.db');
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
        $Select = "SELECT * FROM Future WHERE id = :ID";
        $req = $pdo->prepare($Select);
        $req->bindValue(':ID', $id);
        $req->execute();

        $result = $req->fetchAll();
        $Host = $result[0][1];
        $Visitor = $result[0][2];

        $Select = "SELECT pct FROM Standings WHERE Name = :Name";
        $req = $pdo->prepare($Select);
        $req->bindValue(':Name', $Host);
        $req->execute();
        $result = $req->fetchAll();

        $pctHost = $result[0][0];

        $Select = "SELECT pct FROM Standings WHERE Name = :Name";
        $req = $pdo->prepare($Select);
        $req->bindValue(':Name', $Visitor);
        $req->execute();
        $result = $req->fetchAll();

        $pctVisitor = $result[0][0];

        $diff = abs($pctHost-$pctVisitor);

        if($pctHost > $pctVisitor)
        {
            $HostGain = (2- (0.5 - ($diff/2)));
            $VisitorGain = (2- (0.5 + ($diff/2)));
        }
        else
        {
            $HostGain = (2- (0.5 + ($diff/2)));
            $VisitorGain = (2- (0.5 - ($diff/2)));
        }
        if($team == "Host")
            return $HostGain *$token;
        else
            return $VisitorGain *$token;
    }

    public static function Bet($id, $team, $token,$gain)//ajoute la mise dans la bd
    {
        try {
            $pdo = new PDO('sqlite:../app/Models/bd.db');
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
        $Select = "INSERT INTO Mise(Game,Team,MiseurMise,Gain,Miseur,Status) VALUES(:Game,:Team,:MiseurMise,:Gain,:Miseur,:Status)";
        $req = $pdo->prepare($Select);
        $req->bindValue(':Game', $id);
        $req->bindValue(':Team', $team);
        $req->bindValue(':MiseurMise', $token);
        $req->bindValue(':Gain', $gain);
        $req->bindValue(':Miseur', $_SESSION["MiseurUser"]);
        $req->bindValue(':Status', -1);
        $req->execute();

        $Update = "UPDATE Compte SET CompteToken = CompteToken - :Token";
        $req = $pdo->prepare($Update);
        $req->bindValue(':Token', $token);
        $req->execute();
        $pdo = null;

    }

    public static function DeleteMise($id)//delete la mise donnée
    {
        try {
            $pdo = new PDO('sqlite:../app/Models/bd.db');
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
        $select = "SELECT MiseurMise FROM Mise WHERE ID = :ID";
        $req = $pdo->prepare($select);
        $req->bindValue(':ID', $id);
        $req->execute();
        $Mise = $req->fetchAll(PDO::FETCH_NUM);

        $Delete = "DELETE FROM Mise WHERE ID = :ID";
        $req = $pdo->prepare($Delete);
        $req->bindValue(':ID', $id);
        $req->execute();

        $Update = "UPDATE Compte SET CompteToken = CompteToken + :Token WHERE CompteEmail = :Email";
        $req = $pdo->prepare($Update);
        $req->bindValue(':Token', $Mise[0][0]);
        $req->bindValue(':Email', $_SESSION["MiseurUser"]);
        $req->execute();
        $pdo = null;
    }

    public static function UpdateMise($id,$Team,$Token)//met a jour la mise donnée
    {
        try {
            $pdo = new PDO('sqlite:../app/Models/bd.db');
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
        $select = "SELECT MiseurMise, Game FROM Mise WHERE ID = :ID";
        $req = $pdo->prepare($select);
        $req->bindValue(':ID', $id);
        $req->execute();
        $Mise = $req->fetchAll(PDO::FETCH_NUM);

        $Gain = self::ShowGain($Mise[0][1],$Team,$Token);

        $Update = "UPDATE Mise SET Team = :Team, MiseurMise = :Mise, Gain = :Gain  WHERE ID = :ID";
        $req = $pdo->prepare($Update);
        $req->bindValue(':Mise', $Token);
        $req->bindValue(':Team', $Team);
        $req->bindValue(':ID', $id);
        $req->bindValue(':Gain', round($Gain));
        $req->execute();

        $Update = "UPDATE Compte SET CompteToken = CompteToken + :Token WHERE CompteEmail = :Email";

        $req = $pdo->prepare($Update);
        $req->bindValue(':Token', $Mise[0][0] - $Token);
        $req->bindValue(':Email', $_SESSION["MiseurUser"]);
        $req->execute();

    }
}
?>