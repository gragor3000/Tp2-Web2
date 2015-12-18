<?php
session_start();

if (!(isset($_SESSION['MiseurUser']) && $_SESSION['MiseurUser'] != ''))
    header("location: /Miseur/index");

?>
<html>

<head>
    <script src="/JS/NFL.js"></script>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="/CSS/TP1.css"/>
    <link rel="stylesheet" href="/CSS/bootstrap-3.3.5-dist/css/sticky-footer.css">
    <link rel="stylesheet" href="/CSS/bootstrap-3.3.5-dist/css/bootstrap.css"/>
    <link rel="stylesheet" href="/CSS/bootstrap-3.3.5-dist/css/bootstrap-theme.css"/>

    <!-- Bootstrap core CSS -->

</head>

<body role="document" onload="ShowMise()">

<div class="navbar navbar-default navbar-fixed-topt">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Triangle survey</a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a href="/Miseur/Home">Home</a></li>
                <li class="active"><a href="#"> Mises</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false">Compte <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="/Client/index">Déconnexion</a></li>
                    </ul>
                </li>
            </ul>
            <div class="Bet">
                Équipe:
                <select  id="Team">
                    <option>Host</option>
                    <option>Visitor</option>
                </select>
                Partie:
                <input id="MiseID" type="number">
                Montant:
                <input id="Montant" type="number" min="10" value="10">
                <button onclick="UpdateMise()" class="btn-primary">Modifier</button>
                <button onclick="DeleteMise()" class="btn-danger">Supprimer</button>
            </div>
            <div class="Token">
                Token courant :
                <input readonly type="text" id="CurToken">
            </div>
        </div>
    </div>
</div>

<div class="container2">
    <div class="jumbotron3">
        <button class="btn btn-lg btn-default" onclick="ShowFuture()">Mises</button>
        <Table id="TFut" class="table table-hover table-striped">
            <thead>
            <tr>
                <th>Host</th>
                <th>Visitor</th>
                <th>Team</th>
                <th>Mise</th>
                <th>Gain</th>
            </tr>
            </thead>
            <tbody id="Future"></tbody>
        </Table>
    </div>
</div>

<div class="container2">
    <div class="jumbotron3">
        <button class="btn btn-lg btn-default" onclick="HideOld()">Anciennes Mises</button>
        <Table id="TOld" class="table table-hover table-striped">
            <thead>
            <tr>
                <th>Host</th>
                <th>Visitor</th>
                <th>Team</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody id="Old"></tbody>
        </Table>
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