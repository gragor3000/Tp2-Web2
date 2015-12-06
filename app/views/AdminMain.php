<?php
session_start();

if (!(isset($_SESSION['AdminUser']) && $_SESSION['AdminUser'] != ''))
    header("location:../app/Views/Accueil.php");
?>

<head>
    <script src="../app/Views/JS/NFL.js"></script>
    <script src="JS/NFL.js"></script>
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

<body role="document" onload="Admin()">

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
                <li class="active"><a href="#">Home</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false">Compte <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Paramètre</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="../PHP/EndSession.php">Déconnexion</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <!--/.nav-collapse -->
    </div>
</div>


<div class="container">
    <div class="jumbotron2">
        <h2>Liste des comptes</h2>
        <table class="Account">
            <tr>
                <td>
                    <select name="Liste" class="Liste" size="5" id="ListeCompte"></select>
                </td>
                <td>
                    <div class="textbox">
                        <label for="inputEmail" class="sr-only">Email address</label>
                        <input name="email" id="inputEmail" type="email" placeholder="Email" class="form-control">
                        <label for="inputPassword" class="sr-only">Password</label>
                        <input name="password" id="inputPassword" type="password" placeholder="Mot de Passe"
                               class="form-control">
                        <label for="inputToken" class="sr-only">Token</label>
                        <input name="Token" id="inputToken" type="number" placeholder="Token"
                               class="form-control">
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <br>
                    <button type="button" class="btn btn-lg btn-success" name="Add_btn" value="Add" onclick="AddAccount()">Ajouter</button>
                </td>
                <td>
                    <br>
                    <button type="button" class="btn btn-lg btn-primary" name="Modify_btn" value="Modify" onclick="ModifyAccount()">Modifier
                    </button>
                </td>
                <td>
                    <br>
                    <button type="button" class="btn btn-lg btn-danger" name="Delete_btn" value="Delete" onclick="DeleteAccount()">Supprimer
                    </button>
                </td>
            </tr>
        </table>
    </div>
</div>


<div class="footer">
    <p class="text-muted"><a href="#">Haut de la page</a></p>
</div>

<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>

</html>