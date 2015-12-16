/**
 * Created by 1253250 on 22/10/2015.
 */
var id = 0;

function Admin()//met les comptes dans la liste
{
    var inputEmail = document.getElementById("inputEmail")
    inputEmail.value = ""
    var inputPsw = document.getElementById("inputPassword")
    inputPsw.value = ""
    var inputToken = document.getElementById("inputToken")
    inputToken.value = 20

    var xmlhttp = new XMLHttpRequest();

    xmlhttp.open("POST", "/Admin/Account", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("User=Admin");

    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

            var return_data = xmlhttp.responseText;
            var str = return_data.split('"');
            ShowAccount(str);
        }
    }
}

function ShowAccount(Table) {//affiche les comptes dans la liste
    var lst = document.getElementById("ListeCompte")
    lst.innerHTML = "";

    for (var ii = 1; ii < Table.length - 1; ii++) {

        var data = Table[ii].replace(",", "");
        if (data != "") {
            var ele = document.createElement("option")
            ele.setAttribute("id", ii.toString())
            ele.setAttribute("value", data)
            if (ii == 1)
                ele.setAttribute("selected", "selected")
            ele.appendChild(document.createTextNode(data))
            lst.appendChild(ele)
        }
    }
}
function AddAccount() {//ajoute un compte a la bd
    var xmlhttp = new XMLHttpRequest();
    var inputEmail = document.getElementById("inputEmail");
    var Email = inputEmail.value;
    var inputPsw = document.getElementById("inputPassword");
    var Password = inputPsw.value;
    var inputToken = document.getElementById("inputToken");
    var Token = inputToken.value.toString();

    xmlhttp.open("POST", "/Admin/AddAccount", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("Add=" + Email + "," + Password + "," + Token);

    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            alert("Compte " + Email + " à été ajouté")
            var return_data = xmlhttp.responseText;
            Admin();
        }
    }

}

function ModifyAccount() {//modifie un compte de la bd
    var xmlhttp = new XMLHttpRequest();
    var inputEmail = document.getElementById("inputEmail")
    var Email = inputEmail.value
    var inputPsw = document.getElementById("inputPassword")
    var Password = inputPsw.value
    var inputToken = document.getElementById("inputToken")
    var Token = inputToken.value.toString()
    var lstEmail = document.getElementById("ListeCompte")
    var oldEmail = lstEmail.value

    xmlhttp.open("POST", "/Admin/ModifyAccount", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("Modify="+oldEmail + "," + Email + "," + Password + "," + Token);

    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            alert("Le compte " + oldEmail + " à été modifier")
            Admin();

        }
    }
}

function DeleteAccount() {//supprime un compte de la bd
    var xmlhttp = new XMLHttpRequest();
    var lstEmail = document.getElementById("ListeCompte")
    var oldEmail = lstEmail.value
    xmlhttp.open("POST", "/Admin/DeleteAccount", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("Delete=" +oldEmail);

    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            alert("Le compte " + oldEmail + " à été supprimer")
            Admin();
        }
    }
}

function LoadGame()//load les game future et passée
{
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.open("POST", "/Client/LoadPastGame", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("");

    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            var Table = xmlhttp.responseText;
            var Table2 = Table.split('"');
            PastScore(Table2);
        }
    }




}

function LoadFutureGameHost() {//va chercher les host
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.open("POST", "/Client/LoadFutureGameHost", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("");

    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            var Table = xmlhttp.responseText;
            var Table2 = Table.split('"');
            FutureScore(Table2);
        }
    }

}

function LoadFutureGameVisitor() {//va chercher les visitor
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.open("POST", "/Client/LoadFutureGameVisitor", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("");

    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            var Table = xmlhttp.responseText;
            var Table2 = Table.split('"');
            FutureScore2(Table2);
        }
    }

}


function LoadFutureGameLoc() {//va chercher les Location
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.open("POST", "/Client/LoadFutureGameLoc", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("");

    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            var Table = xmlhttp.responseText;
            var Table2 = Table.split('"');
            FutureScore2(Table2);
        }
    }
}


function PastScore(TablePast) {//affiche les parties passées

    var Table = document.getElementById("Past")

    for (var i = 1; i < TablePast.length - 1; i++) {

        var data = TablePast[i].replace(",", "");

        var tr = document.createElement("tr");
        var td = document.createElement("td");
        td.appendChild(document.createTextNode(data));
        td.setAttribute("id", "Ptd." + i.toString());
        tr.appendChild(td);
        tr.setAttribute("id", "Ptr." + i.toString());
        Table.appendChild(tr);
    }
    LoadFutureGameHost();
}

function FutureScore(TableFuture) {//affiche les parties futures avec leur id

    var Table = document.getElementById("Future")
    for (var i = 1; i < TableFuture.length - 1; i++) {

        var data = TableFuture[i].replace(",", "");

        var tr = document.createElement("tr");
        var td = document.createElement("td");
        if(data != "") {
            if(Table.children.length == 0)
                id = 1;
            td.appendChild(document.createTextNode((id).toString() + ". " + data));
            id++;
        }
        else
            td.appendChild(document.createTextNode(data));
        tr.appendChild(td);
        tr.setAttribute("id", "Ftr." + i.toString());
        Table.appendChild(tr);
    }
    LoadFutureGameVisitor();
    LoadFutureGameLoc();
}

function FutureScore2(TableFuture) {//affiche les parties futures avec déjà les lignes de créer

    for (var i = 1; i < TableFuture.length - 1; i++) {

        var data = TableFuture[i].replace(",", "");

        var tr = document.getElementById("Ftr." + i.toString());
        var td = document.createElement("td");
        td.appendChild(document.createTextNode(data));
        tr.appendChild(td);
    }
}

function ShowFuture()//montre ou cache les parties futures
{
    var Table = document.getElementById("TFut");
    if (Table.style.display == "none")
        Table.style.display = "inline";
    else
        Table.style.display = "none";
}

function ShowPast()//montre ou cache les parties passé
{
    var Table = document.getElementById("TPast");
    if (Table.style.display == "none")
        Table.style.display = "inline";
    else
        Table.style.display = "none";
}

function Update()//fait la mise a jour de la bd
{
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.open("POST", "/Client/Update", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("");

    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            LoadGame();
            alert("Mise à jour effectué!");
        }
    }
}

function LoadAPI()//load les info de la page d'API
{
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.open("POST", "/API/Teams", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("");

    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            var Table = xmlhttp.responseText;
            LoadAPITeam(Table)
        }
    }
}

function LoadAPITeam(Table)//met le résulat dans le html
{
    var Table2 = document.getElementById("TTeam");

    var tr = document.createElement("tr");
    tr.appendChild(document.createTextNode(Table));
    Table2.appendChild(tr);
    LoadAPIFuture();
}

function ShowTeam()//montre ou cache les parties futures
{
    var Table = document.getElementById("TTeam");
    if (Table.style.display == "none")
        Table.style.display = "inline";
    else
        Table.style.display = "none";
}

function ShowMatch()
{
    var Table = document.getElementById("TFut");
    if (Table.style.display == "none")
        Table.style.display = "inline";
    else
        Table.style.display = "none";
}


function LoadAPIFuture()//load les info de la page d'API
{
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.open("POST", "/API/LoadAPIFuture", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("");

    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            var Table = xmlhttp.responseText;
            LoadAPIFutureTable(Table);
        }
    }
}


function LoadAPIFutureTable(Table) {//met les parties future dans la table
    var Table2 = document.getElementById("TFut");

    var tr = document.createElement("tr");
    tr.appendChild(document.createTextNode(Table));
    Table2.appendChild(tr);
}

function AddToken()//ajoute des tokens a l'utilisateur connecter
{
    var xmlhttp = new XMLHttpRequest();
    var input = document.getElementById("Token");
    var Token = input.value;

    xmlhttp.open("POST", "/Miseur/AddToken", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("Token="+Token);

    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            alert(Token + " token a été ajouté")
        }
    }

    ShowToken();
}

function ShowInfo()//montre les token du miseur en cours
{
    LoadFutureGameHost();
    ShowToken();
}

function ShowToken()//montre les token de l'utilisateur
{
    var xmlhttp = new XMLHttpRequest();
    var Token = document.getElementById("CurToken");

    xmlhttp.open("POST", "/Miseur/ShowToken", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send();

    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            var ValToken = xmlhttp.responseText;
            Token.value = ValToken;
            MaxBet(ValToken);
        }
    }

}

function MaxBet(max)//set le max du nombre de token que l'utilisateur peut mettre sur une mise
{
    if(max != null) {
        var bet = document.getElementById("Montant")
        bet.setAttribute("max", parseInt(max));
    }
}











