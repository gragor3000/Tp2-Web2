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

<body role="document" onload="ShowInfo()">

<div class="navbar navbar-default navbar-fixed-top">
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
                <li class="active"><a href="#">Home</a></li>
                <li><a href="/Miseur/Mise"> Mises</a></li>
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
                <select onchange="ShowGain()" id="Team">
                    <option>Host</option>
                    <option>Visitor</option>
                </select>
                Partie:
                <input onchange="ShowGain()" id="GameID" type="number" min="1" value="1">
                Montant:
                <input onchange="ShowGain()" id="Montant" type="number" min="10" value="10">
                Gain:
                <input readonly id="Gain" type="number" >
                <button onclick="Bet()" class="btn-primary">Miser !</button>
            </div>
            <div class="Token">
                Token courant :
                <input readonly type="text" id="CurToken">
            </div>
        </div>
    </div>
</div>

<div class="container2">
    <div class="jumbotron2">
        <input id="Token" class="form-control" type="number" min="1" value="1">
        <a onclick="AddToken()" href="#"><img src="/CSS/Image/Paynow.png"></a>
    </div>
</div>

<div class="container">
    <div class="jumbotron3">
        <button class="btn btn-lg btn-default" onclick="ShowFuture()">Parties Future</button>
        <Table id="TFut" class="table table-hover table-striped">
            <thead>
            <tr>
                <th>Host</th>
                <th>Visitor</th>
                <th>Location</th>
            </tr>
            </thead>
            <tbody id="Future"></tbody>
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