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
                <li><a  href="/Miseur/Mise">Home</a></li>
                <li class="active"><a href="#"> Mises</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false">Compte <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="/Client/index">Déconnexion</a></li>
                    </ul>
                </li>
            </ul>
            <div class="Token">
                Token :
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


<div class="footer">
    <p class="text-muted"><a href="#">Haut de la page</a></p>
</div>

<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>

</html>