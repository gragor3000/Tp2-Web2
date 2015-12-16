
<html>

<head>
    <meta charset="utf-8"/>
    <script src="/JS/NFL.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="/CSS/TP1.css"/>
    <link rel="stylesheet" href="/CSS/bootstrap-3.3.5-dist/css/sticky-footer.css">
    <link rel="stylesheet" href="/CSS/bootstrap-3.3.5-dist/css/bootstrap.css"/>
    <link rel="stylesheet" href="/CSS/bootstrap-3.3.5-dist/css/bootstrap-theme.css"/>


</head>

<body onload="LoadGame()">

<div class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <ul class="nav navbar-nav">
                <li class="active">
                    <a class="navbar-brand" href="#">Triangle Football</a>
                </li>
                <li>
                    <a class="navbar-brand" href="/API/index">API</a>
                </li>
            </ul>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <form class="navbar-form navbar-right" method="post" action="/Client/login">
                <div class="form-group">
                    <label for="inputEmail" class="sr-only">Email address</label>
                    <input name="email" id="inputEmail" type="email" placeholder="Email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="inputPassword" class="sr-only">Password</label>
                    <input name="password" id="inputPassword" type="password" placeholder="Mot de Passe"
                           class="form-control">
                </div>
                <button type="submit" class="btn btn-success">Connexion</button>
                <button class="btn btn-primary" onclick="Update()">MàJ Stats</button>

            </form>
        </div>
    </div>
</div>


<div class="container">
    <div class="jumbotron2">
        <button class="btn btn-lg btn-default" onclick="ShowPast()">Résultat</button>
        <Table id="TPast" class="table table-hover table-striped ">
            <thead>
            <tr>
                <th><h1>Result</h1></th>
            </tr>
            </thead>
            <tbody id="Past"></tbody>
        </Table>
    </div>
</div>

<div class="container">
    <div class="jumbotron2">
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

