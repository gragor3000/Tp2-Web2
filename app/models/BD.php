
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
        return $value[0][2];


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

        return $req->fetchAll();

    }

    public static function LoadFutureGame()//donne les games future
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



    function Sondeur($email)//load la page d'un compte d'un sondeur
    {

        try {
            $_SESSION['User'] = $email;
            $doc = new DOMDocument();
            $doc->loadHTMLFile("../app/views/home/HTML/ClientMain.php");
            $h1 = $doc->createElement("h1");
            $h1->appendChild($doc->createTextNode("Bienvenue " . $_SESSION['User'] . " !"));
            $h1->setAttribute("class", "Titre");
            $div = $doc->GetElementById("container");
            $div->insertBefore($h1, $div->firstChild);
            echo $doc->saveHTML();
        } catch (PDOException $ex) {
            echo "Connection failed: " . $ex->getMessage();
        }
    }


    function CreationSondage($Post)//cr�er le nouveau sondage
    {
        try {
            $pdo = new PDO('sqlite:bd.sqlite3');
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
        $date = date("Y/m/d");
        $add_days = 3.5;
        $date = date('Y-m-d', strtotime($date) + (24 * 3600 * $add_days)); //my preferred method
//or
        $date1 = date('Y-m-d', strtotime($date . ' +' . $add_days . ' days'));

        $insert = "INSERT INTO Sondage(SondageMdp,SondageCompte,SondageActive,SondageDateDebut,SondageDateFin) VALUES(:SondageMdp,:SondageCompte,:SondageActive,:SondageDateDebut,:SondageDateFin)";
        $requete = $pdo->prepare($insert);
        $mdp = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10);
        $requete->bindValue(':SondageMdp', $mdp);
        $requete->bindValue(':SondageCompte', $_SESSION['User']);
        $requete->bindValue(':SondageActive', 1);
        $requete->bindValue(':SondageDateDebut', date("d/m/Y"));
        $requete->bindValue(':SondageDateFin', $date1);


        // Execute la requ�te
        $requete->execute();

        $pdo = null;

        $doc = new DOMDocument();
        $doc->loadHTMLFile("../HTML/Question.php");
        $Questions = $doc->getElementById('Questions');
        $h1 = $doc->createElement("h1");
        $h1->appendChild($doc->createTextNode("Mot de passe : " . $mdp));
        $Questions->appendChild($h1);
        echo $doc->saveHTML();

        for ($ii = 1; $ii <= count($Post) - (count($Post) / 2); $ii++) {
            $Question = $Post['Question' . $ii];
            $Type = $Post['Type' . $ii];
            AddQuestionsBD($Question, $Type);
        }
    }

    function AddQuestionsBD($Question, $Type)//ajoute les questions au sondage dans la bd
    {
        try {
            $pdo = new PDO('sqlite:bd.sqlite3');
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }

        $str = "SELECT SondageID FROM Sondage ORDER BY SondageID DESC";
        $Select = $pdo->prepare($str);
        $Select->execute();

        $value = $Select->fetchAll();
        $pdo = null;

        try {
            $pdo = new PDO('sqlite:bd.sqlite3');
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }

        $insert = "INSERT INTO Question (QuestionQuestion, QuestionType, QuestionSondageID) VALUES (:QuestionQuestion, :QuestionType,:QuestionSondageID)";
        $requete = $pdo->prepare($insert);
        $requete->bindValue(':QuestionQuestion', $Question);
        $requete->bindValue(':QuestionType', $Type);
        $requete->bindValue(':QuestionSondageID', $value[0][0]);


        // Execute la requ�te
        $requete->execute();

        $pdo = null;
    }


    function CreationCorpsSondage($nbQuestion)//cr�er le corps
    {

        $doc = new DOMDocument();
        $doc->loadHTMLFile("../HTML/Question.php");
        for ($ii = 1; $ii <= $nbQuestion; $ii++) {
            AjoutCorpsQuestion($doc, $ii);
        }
        //bouton de confirmation
        $button = $doc->createElement("button");
        $button->setAttribute("type", "submit");
        $button->setAttribute("class", "btn btn-lg btn-default");
        $button->appendChild($doc->createTextNode("Confirmer "));
        $glyphSpan = $doc->createElement("span");
        $glyphSpan->setAttribute("class", "glyphicon glyphicon-ok-circle");
        $glyphSpan->setAttribute("aria-hidden", "true");
        $button->appendChild($glyphSpan);

        $Questions = $doc->getElementById('Questions');
        $Questions->appendChild($button);
        echo $doc->saveHTML();
    }

    function AjoutCorpsQuestion($doc, $ii)//ajoute le corps de question pr�te a �tre cr�er
    {
        //div contenant toute les questions
        $Questions = $doc->getElementById('Questions');
        $Questions->setAttribute("style", "margin-bottom : 10%");

        //div de la question
        $div = $doc->createElement("div");
        $div->setAttribute("id", "Question" . $ii);
        $div->setAttribute("style", "color : black");

        //textbox de la question
        $Text = $doc->createElement("textArea");
        $Text->setAttribute("Name", "Question" . $ii);
        $Text->setAttribute("style", "width : 20%;height : 8%;");
        $Text->setAttribute("cols", "80");
        $Text->setAttribute("rows", "5");

        //titre de la question
        $label = $doc->createElement("label");
        $label->setAttribute("style", "color : white");
        $label->appendChild($doc->createTextNode("Question " . $ii . ":"));

        //label du type de question a d�veloppement
        $labelT1 = $doc->createElement("label");
        $labelT1->setAttribute("style", "color : white");
        $labelT1->appendChild($doc->createTextNode(" Developpement: "));

        //label du type de question d'appr�ciation
        $labelT2 = $doc->createElement("label");
        $labelT2->setAttribute("style", "color : white");
        $labelT2->appendChild($doc->createTextNode(" Appreciation: "));

        //radio button de d�veloppement
        $Type1 = $doc->createElement("input");
        $Type1->setAttribute("type", "radio");
        $Type1->setAttribute("name", "Type" . $ii);
        $Type1->setAttribute("value", "0");
        $Type1->setAttribute("checked", "checked");
        $labelT1->appendChild($Type1);

        //radio button d'appr�ciation
        $Type2 = $doc->createElement("input");
        $Type2->setAttribute("type", "radio");
        $Type2->setAttribute("name", "Type" . $ii);
        $Type2->setAttribute("value", "1");
        $labelT2->appendChild($Type2);


        $br1 = $doc->createElement("br");
        $br2 = $doc->createElement("br");

        $div->appendChild($label);
        $div->appendChild($br1);
        $div->appendChild($Text);
        $div->appendChild($br2);
        $div->appendChild($labelT1);
        $div->appendChild($labelT2);
        $Questions->appendChild($div);
    }

    function AfficherSondage($mdp)//affiche le sondage li� au mot de passe donn�e
    {
        try {
            $pdo = new PDO('sqlite:bd.sqlite3');
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }

        $str = "SELECT SondageID, SondageActive, SondageDateFin FROM Sondage WHERE SondageMdp = :SondageMdp";
        $Select = $pdo->prepare($str);
        $Select->bindValue(':SondageMdp', $mdp);
        $Select->execute();

        $Sondage = $Select->fetchAll(PDO::FETCH_NUM);
        $date = date("d/m/Y");

        if ($Sondage[0][1] == 1 && $Sondage[0][2]) {

            $Select2 = $pdo->prepare("SELECT QuestionQuestion, QuestionType,QuestionID FROM Question WHERE QuestionSondageID = :SondageID ");
            $Select2->bindValue(':SondageID', $Sondage[0][0]);
            $Select2->execute();

            $Question = $Select2->fetchAll(PDO::FETCH_NUM);

            $_SESSION['Question'] = $Question;
            $doc = new DOMDocument();
            $doc->loadHTMLFile("../HTML/Question.php");


            for ($ii = 0; $ii < count($Question); $ii++) {
                AddQuestion($doc, $Question[$ii][0], $Question[$ii][1], $ii + 1);
            }

            $button = $doc->createElement("button");
            $button->setAttribute("type", "submit");
            $button->setAttribute("class", "btn btn-lg btn-default");
            $button->appendChild($doc->createTextNode("Confirmer "));
            $glyphSpan = $doc->createElement("span");
            $glyphSpan->setAttribute("class", "glyphicon glyphicon-ok-circle");
            $glyphSpan->setAttribute("aria-hidden", "true");
            $button->appendChild($glyphSpan);

            $Questions = $doc->getElementById('Questions');
            $Questions->appendChild($button);
            $Form = $doc->getElementById("Form1");
            $Form->setAttribute("action", "../PHP/Reponse.php");
            echo $doc->saveHTML();
        } else {
            echo "<script>alert('sondage inaccessible') </script>";
            $doc = new DOMDocument();
            $doc->loadHTMLFile("../HTML/ClientMain.php");
            echo $doc->saveHTML();
        }


    }

    function AddQuestion($doc, $Question, $Type, $ii)//ajoute les questions dans le html pour qu'il soit compl�ter
    {
        //div contenant toute les questions
        $Questions = $doc->getElementById('Questions');
        $Questions->setAttribute("style", "margin-bottom : 10%");

        //div de la question
        $div = $doc->createElement("div");
        $div->setAttribute("id", "Question" . $ii);
        $div->setAttribute("style", "color : black");


        //titre de la question
        $label = $doc->createElement("label");
        $label->setAttribute("style", "color : white");
        $label->appendChild($doc->createTextNode("Question " . $ii . ":" . $Question));

        $br1 = $doc->createElement("br");
        $br2 = $doc->createElement("br");

        $div->appendChild($label);
        $div->appendChild($br1);
        if ($Type == 0) {
            //textbox de la r�ponse
            $Text = $doc->createElement("textArea");
            $Text->setAttribute("cols", "80");
            $Text->setAttribute("rows", "5");
            $Text->setAttribute("Name", "Reponse" . $ii);
            $Text->setAttribute("style", "width : 20%;height : 8%;");
            $Text->setAttribute("required", "");
            $div->appendChild($Text);
        } else {
            for ($Rii = 1; $Rii <= 10; $Rii++) {
                //radiobutton de la question
                //label du type de question d'appr�ciation
                $labelT2 = $doc->createElement("label");
                $labelT2->setAttribute("style", "color : white");
                $labelT2->appendChild($doc->createTextNode(" $Rii: "));
                $Text = $doc->createElement("input");
                $Text->setAttribute("type", "radio");
                $Text->setAttribute("name", "Reponse" . $ii);
                $Text->setAttribute("value", $Rii);
                if ($Rii == 1)
                    $Text->setAttribute("checked", "checked");
                $div->appendChild($labelT2);
                $div->appendChild($Text);
            }
        }
        $div->appendChild($br2);
        $hr = $doc->createElement("hr");
        $hr->setAttribute("class", "style5");
        $div->appendchild($hr);
        $Questions->appendChild($div);
    }

    function AddReponse($Question, $Reponse)//ajoute les r�ponses au questions
    {
        try {
            $pdo = new PDO('sqlite:bd.sqlite3');
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
        $insert = "INSERT INTO Reponse(ReponseReponse,ReponseQuestionID) VALUES(:ReponseReponse,:ReponseQuestionID)";
        $requete = $pdo->prepare($insert);

        for ($ii = 0; $ii < count($Question); $ii++) {
            $requete->bindValue(':ReponseReponse', $Reponse['Reponse' . ($ii + 1)]);
            $requete->bindValue(':ReponseQuestionID', $Question[$ii][2]);

            // Execute la requ�te
            $requete->execute();

        }
        $doc = new DOMDocument();
        $doc->loadHTMLFile("../HTML/ClientMain.php");
        echo $doc->saveHTML();
        echo "<script type='text/javascript'>alert('Sondage complete !');</script>";
        $pdo = null;
    }


    function LoadSondage($doc, $data, $ii)//load les sondages dans la liste
    {
        $lst = $doc->getElementById('ListeSondage');
        $ele = $doc->createElement("option");
        $ele->setAttribute("id", $ii);
        $ele->setAttribute("value", $data);
        if ($ii == 0)
            $ele->setAttribute("selected", "selected");
        $ele->appendChild($doc->createTextNode($data));
        $lst->appendChild($ele);
    }

    function ShowSondages()//montre les sondages cr�er � l'utilisateur
    {

        try {
            $pdo = new PDO('sqlite:bd.sqlite3');
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }

        try {
            $req = $pdo->prepare("SELECT SondageMdp FROM Sondage");
            $req->execute();

            $value = $req->fetchAll();

            $doc = new DOMDocument();
            $doc->loadHTMLFile("../HTML/ShowSondage.php");


            $ii = 0;
            foreach ($value as $data) {//remplit ma liste de tous les comptes
                LoadSondage($doc, $data['SondageMdp'], $ii);
                $ii++;
            }
            echo $doc->saveHTML();
            $pdo = null;
        } catch (PDOException $ex) {
            echo "Connection failed: " . $ex->getMessage();
        }
    }

    function ModifSondage($Mdp, $Debut, $Fin, $Active)//modifie le sondage
    {
        if ($Debut < $Fin) {
            try {
                $pdo = new PDO('sqlite:bd.sqlite3');
            } catch (PDOException $e) {
                echo 'Connection failed: ' . $e->getMessage();
            }


            $Update = "Update Sondage SET SondageActive = :SondageActive, SondageDateDebut = :SondageDateDebut, SondageDateFin = :SondageDateFin WHERE SondageMdp = :SondageMdp";
            $req = $pdo->prepare($Update);
            $req->bindValue(':SondageActive', $Active);
            $req->bindValue(':SondageDateDebut', $Debut);
            $req->bindValue(':SondageDateFin', $Fin);
            $req->bindValue(':SondageMdp', $Mdp);
            $req->execute();
        } else
            echo "<script> alert('date de debut apres la date de fin') </script>";

        ShowSondages();

    }

    function PhpExcel()//cr�er le fichier excel
    {
        require_once "../Classes/PHPExcel.php";
        $objPHPExcel = new PHPExcel();
// Set properties
        $objPHPExcel->getProperties()->setCreator("ThinkPHP")
            ->setLastModifiedBy("Daniel Schlichtholz")
            ->setTitle("Office 2007 XLSX Test Document")
            ->setSubject("Office 2007 XLSX Test Document")
            ->setDescription("Test doc for Office 2007 XLSX, generated by PHPExcel.")
            ->setKeywords("office 2007 openxml php")
            ->setCategory("Test result file");
        $objPHPExcel->getActiveSheet()->setTitle('Minimalistic demo');

        try {
            $pdo = new PDO('sqlite:bd.sqlite3');
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }

        $Select1 = $pdo->prepare("SELECT QuestionQuestion,QuestionID FROM Question");
        $Select1->execute();

        $Question = $Select1->fetchAll(PDO::FETCH_NUM);


        for ($i = 0; $i < count($Question); $i++) {
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A' . ($i + 1), implode($Question[$i]));
        }

        $Select2 = $pdo->prepare("SELECT ReponseReponse FROM Reponse");
        $Select2->execute();
        $Reponse = $Select2->fetchAll((PDO::FETCH_NUM));

        for ($ii = 0; $ii < count($Reponse); $ii++) {
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('E' . ($ii + 1), implode($Reponse[$ii]));
        }


        require_once '../Classes/PHPExcel/IOFactory.php';
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
// If you want to output e.g. a PDF file, simply do:
        //$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'PDF');
        $objWriter->save('MyExcel.xlsx');
        header("location: ../HTML/ClientMain.php");
    }
}

?>