<?php
/**
 * Created by PhpStorm.
 * User: Mic
 * Date: 2015-10-25
 * Time: 16:30
 */
include_once("BD.php");
Class Account
{
    public static function Admin()//load et envoi les comptes a ajax pour les ajouté a la liste
    {
        $data = "";
        try {
            $pdo = new PDO('sqlite:../app/Models/bd.db');
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }


        try {
            $req = $pdo->prepare("SELECT CompteEmail FROM Compte");
            $req->execute();

            $value = $req->fetchAll();

            foreach ($value as $datas) {//remplit ma liste de tous les comptes
                //ShowAccount( $data['CompteEmail'], $ii);

                $one = $datas['CompteEmail'];
                $data = "$data" . "," . "$one";
            }
            //echo $doc->saveHTML();
            $pdo = null;
        } catch (PDOException $ex) {
            echo "Connection failed: " . $ex->getMessage();
        }
        return $data;

    }



    function AddAccount($email, $password, $Admin)//ajoute un compte
    {
        try {
            $pdo = new PDO('sqlite:../app/Models/bd.db');
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }


        $insert = "INSERT INTO Compte (CompteEmail, ComptePassword, CompteAdmin) VALUES (:CompteEmail, :ComptePassword,:Admin)";
        $requete = $pdo->prepare($insert);
        $requete->bindValue(':CompteEmail', $email);
        $requete->bindValue(':ComptePassword', md5($password));
        $requete->bindValue(':Admin', $Admin);

        // Execute la requ�te
        $requete->execute();


        Admin();
        echo "<script> alert('Le compte : (" . $email . ") a ete ajouter')</script>";
        $pdo = null;
    }

    function ModifyAccount($oldEmail, $Email, $Password, $Admin)//modifie le compte s�lectionn�
    {
        try {
            $pdo = new PDO('sqlite:../app/Models/bd.db');
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
        $Update = "Update Compte SET CompteEmail = :Email, ComptePassword = :Password, CompteAdmin = :Admin WHERE CompteEmail = :oldEmail";
        $req = $pdo->prepare($Update);
        $req->bindValue(':Email', $Email);
        $req->bindValue(':Password', md5($Password));
        if ($Admin == "on")
            $req->bindValue(':Admin', 1);
        else
            $req->bindValue(':Admin', 0);
        $req->bindValue(':oldEmail', $oldEmail);
        $req->execute();
        Admin();
        echo "<script> alert('Le compte :" . $oldEmail . " a ete modifier')</script>";
        $pdo = null;
    }

    function DeleteAccount($Email)//delete le compte s�lectionn�
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
        Admin();
        echo "<script> alert('Le compte : (" . $Email . ") a ete supprimer')</script>";
        $pdo = null;
    }
}

