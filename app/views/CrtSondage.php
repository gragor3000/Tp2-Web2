<?php
session_start();

if(!(isset($_SESSION['User']) && $_SESSION['User'] != ''))
    header("location: ../HTML/Accueil.php");
?>
<html>

<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="../app/CSS/TP1.css"/>
    <link rel="stylesheet" href="../app/CSS/bootstrap-3.3.5-dist/css/sticky-footer.css">
    <link rel="stylesheet" href="../app/CSS/bootstrap-3.3.5-dist/css/bootstrap.css"/>
    <link rel="stylesheet" href="../app/CSS/bootstrap-3.3.5-dist/css/bootstrap-theme.css"/>
    <link rel="stylesheet" href="../../../app/CSS/TP1.css"/>
    <link rel="stylesheet" href="../../../app/CSS/bootstrap-3.3.5-dist/css/sticky-footer.css">
    <link rel="stylesheet" href="../../../app/CSS/bootstrap-3.3.5-dist/css/bootstrap.css"/>
    <link rel="stylesheet" href="../../../app/CSS/bootstrap-3.3.5-dist/css/bootstrap-theme.css"/>

    <!-- Bootstrap core CSS -->

</head>

<body role="document">

<div class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Triangle survey</a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a href="../HTML/ClientMain.php">Home</a></li>
                <li class="active"><a href="../HTML/CrtSondage.php">Création de sondage</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false">Compte <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a  type="submit" href="../PHP/seeSondage.php">Mes Sondages</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a  href="../PHP/EndSession.php">Déconnexion</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>


<div id="container" class="container">
    <div class="jumbotron2">
        <form method="post" action="../PHP/CorpsSondage.php">
            <h2>Quantité de Questions</h2>
            <table class="Account">
                <tr>
                    <td>
                        <label for="Qte" class="sr-only">Quantité</label>
                        <input name="Qte" id="Qte" type="number" min="1" placeholder="Quantité" class="form-control">
                    </td>
                </tr>
                <tr>
                    <td>
                        <br>
                        <button style="margin-left: 45%;" type="submit" class="btn btn-lg btn-success" name="Creer_btn"
                                value="Accede">Créer
                        </button>
                    </td>
                </tr>
            </table>

        </form>
    </div>
</div>


<div class="footer navbar-fixed-bottom">
    <p class="text-muted"><a href="#">Haut de la page</a></p>
</div>

<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>

</html>