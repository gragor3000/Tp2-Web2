<?php
/**
 * Created by PhpStorm.
 * User: Mic
 * Date: 2015-10-25
 * Time: 16:30
 */
include_once("BD.php");
session_start();
Class Account
{
    public static function Admin()//load et envoi les comptes a ajax pour les ajouté a la liste
    {
        try {
            $pdo = new PDO('sqlite:../app/Models/bd.db');
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }


        try {
            $req = $pdo->prepare("SELECT CompteEmail FROM Compte WHERE CompteAdmin = 0");
            $req->execute();

            $value = $req->fetchAll(PDO::FETCH_COLUMN);

            //echo $doc->saveHTML();
            $pdo = null;
        } catch (PDOException $ex) {
            echo "Connection failed: " . $ex->getMessage();
        }
        return $value;

    }



    public static function AddAccount($email, $password, $Token)//ajoute un compte
    {
        try {
            $pdo = new PDO('sqlite:../app/Models/bd.db');
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }

        $insert = "INSERT INTO Compte (CompteEmail, ComptePassword, CompteAdmin,CompteToken) VALUES (:CompteEmail, :ComptePassword,0,:CompteToken)";
        $requete = $pdo->prepare($insert);
        $requete->bindValue(':CompteEmail', $email);
        $requete->bindValue(':ComptePassword', md5($password));
        $requete->bindValue(':CompteToken', $Token);
        // Execute la requ�te
        $requete->execute();

        $pdo = null;
    }

    public static function ModifyAccount($oldEmail, $Email, $Password, $Token)//modifie le compte s�lectionn�
    {
        try {
            $pdo = new PDO('sqlite:../app/Models/bd.db');
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }

        $Update = "Update Compte SET CompteEmail = :Email, ComptePassword = :Password, CompteAdmin = 0, CompteToken = :CompteToken WHERE CompteEmail = :oldEmail";
        $req = $pdo->prepare($Update);
        $req->bindValue(':Email', $Email);
        $req->bindValue(':Password', md5($Password));
        $req->bindValue(':CompteToken',$Token);
        $req->bindValue(':oldEmail', $oldEmail);
        $req->execute();
        $pdo = null;
    }

    public static function DeleteAccount($Email)//delete le compte s�lectionn�
    {
        try {
            $pdo = new PDO('sqlite:../app/Models/bd.db');
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
        $Delete = "DELETE FROM Compte WHERE CompteEmail = :Email";
        $req = $pdo->prepare($Delete);
        $req->bindValue(':Email', $Email);
        $req->execute();
        $pdo = null;
    }

    public static function AddToken($Token)//ajoute les token dans la bd
    {
        $user = $_SESSION["MiseurUser"];
        try {
            $pdo = new PDO('sqlite:../app/Models/bd.db');
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
        $Update = "Update Compte Set CompteToken = CompteToken + :Token WHERE CompteEmail = :Users";
        $req = $pdo->prepare($Update);
        $req->bindValue(':Token',$Token);
        $req->bindValue(':Users',$user);
        $req->execute();
        $pdo = null;
    }

    public static function ShowToken()
    {
        $user = $_SESSION["MiseurUser"];
        try {
            $pdo = new PDO('sqlite:../app/Models/bd.db');
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
        $Update = "Select CompteToken FROM Compte WHERE CompteEmail = :Users";
        $req = $pdo->prepare($Update);
        $req->bindValue(':Users',$user);
        $req->execute();
        $pdo = null;
        return $req->fetchAll(PDO::FETCH_NUM);
    }
}

