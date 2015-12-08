/**
 * Created by 1253250 on 22/10/2015.
 */
function Admin()//met les comptes dans la liste
{
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.open("POST", "../../controllers/Admin.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("User=Admin");

    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

            var return_data = xmlhttp.responseText;
            var str = return_data.split(",")
            for (var ii = 0; ii < str.length; ii++) {
                var lst = document.getElementById("ListeCompte")
                var ele = document.createElement("option")
                ele.setAttribute("id", ii.toString())
                ele.setAttribute("value", str[ii])
                if (ii == 0)
                    ele.setAttribute("selected", "selected")
                ele.appendChild(document.createTextNode(str[ii]))
                lst.appendChild(ele)
            }
        }
    }
}

function AddAccount() {//ajoute un compte a la bd
    var xmlhttp = new XMLHttpRequest();
    var inputEmail = document.getElementById("inputEmail")
    var Email = inputEmail.value
    var inputPsw = document.getElementById("inputPassword")
    var Password = inputPsw.value
    var inputToken = document.getElementById("inputToken")
    var Token = inputToken.value.toString()

    xmlhttp.open("POST", "../../app/Models/Account.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(Email+","+Password+","+Token);

    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

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

    xmlhttp.open("POST", "../../Models/Account.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(oldEmail+","+Email+","+Password+","+Token);

    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {


        }
    }
}

function DeleteAccount() {//supprime un compte de la bd
    var xmlhttp = new XMLHttpRequest();
    var lstEmail = document.getElementById("ListeCompte")
    var oldEmail = lstEmail.value
    xmlhttp.open("POST", "../../Models/Account.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(oldEmail.toString());

    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {


        }
    }
}

function LoadGame()//load les game future et passée
{
    var xmlhttp = new XMLHttpRequest();
    var TablePast = document.getElementById("Past")
    var TableFuture = document.getElementById("Future")
    xmlhttp.open("POST", "localhost:8080/TP2-Web2/public/Client/LoadGame", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("Action=Game");

    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            var Tables = xmlhttp.responseText;
            var TablePast = Tables[0].split(',')
            var TableFuture = Tables[1].split(',')

        }
    }
}



