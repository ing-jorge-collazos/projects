$(document).ready(function() {
    initialData();
    var session = sessionStorage.getItem('user');
    if (session != null)
        window.location.href = "rrhh.html";
});

function initialData() {
    $("#content-name").hide();
    $("#content-lastname").hide();
    $("#btn-cancel").hide();
    console.log(localStorage.getItem('users'));
    var u = localStorage.getItem('users');
    if (u == null) {
        var users = [
            { "user": "user", "pass": "123" }
        ];
        localStorage.setItem('users', JSON.stringify(users));
    }
}

$("#btn-login").on("click", function() {
    var text = $("#btn-login").text();
    if (text == 'Login')
        do_login();
    else
        do_register();
});

$("#btn-cancel").on("click", function() {
    $("#btn-login").text('Login');
    $("#content-name").hide();
    $("#content-lastname").hide();
    $("#btn-cancel").hide();
    //console.log("submit")
});

$("#btn-register").on("click", function() {
    $("#btn-login").text('Sign up');
    $("#content-name").show();
    $("#content-lastname").show();
    $("#btn-cancel").show();
    //console.log("submit")
});

function do_login() {
    var username = $("#username").val();
    var pass = $("#password").val();
    var validate = false;
    if (username != "" && pass != "") {
        var json = JSON.parse(localStorage.getItem('users'));
        console.log(json);
        for (var i = 0; i < json.length; i++) {
            if (json[i].user == username && json[i].pass == pass) {
                validate = true;
                break;
            }
        }

        if (validate) {
            window.location.href = "rrhh.html";
            sessionStorage.setItem('user', username)
        } else {
            $("#loading_spinner").css({ "display": "none" });
            alert("Wrong Details");
        }
    } else {
        alert("Please Fill All The Details");
    }

    return false;
}

function do_register() {
    var username = $("#username").val();
    var pass = $("#password").val();
    var name = $("#name").val();
    var lastname = $("#lastname").val();
    var valid = false;
    if (name != "" && lastname != "" && username != "" && pass != "") {
        var json = JSON.parse(localStorage.getItem('users'));
        console.log(json);
        console.log(json.length);
        for (var i = 0; i < json.length; i++) {
            console.log(json[i]);
            if (json[i].user == username && json[i].pass == pass) {
                valid = true;
                break;
            }
        }

        if (valid) {
            alert("User Exist!");
        } else {
            $("#btn-login").text('Login');
            $("#content-name").hide();
            $("#content-lastname").hide();
            $("#btn-cancel").hide();
            json.push({ "user": username, "pass": pass });
            localStorage.setItem('users', JSON.stringify(json));
        }

    } else {
        alert("Please Fill All The Details");
    }

    return false;
}