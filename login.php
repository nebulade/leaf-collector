<?php

require_once("util.php");

?>

<!DOCTYPE PHP>
<html>
  <head>
    <meta charset="utf-8">
    <title>Leaf Collector</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Leaf Collector">
    <meta name="author" content="Johannes Zellner">

    <!-- Le styles -->
    <link href="lib/bootstrap/css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
      .sidebar-nav {
        padding: 9px 0;
      }
    </style>
    <link href="lib/bootstrap/css/bootstrap-responsive.css" rel="stylesheet">

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <style>
        .login-container {
            margin: 0 auto;
            width: 200px;
        }
    </style>
  </head>

<body>
    <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container-fluid">
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <a class="brand" href="#">Leaf Collector</a>
            </div>
        </div>
    </div>

    <div class="login-container container-fluid">
        <form action="javascript: login();">
                <h2>Login</h2>
                <div class="text-error hide" id="errorIndicator">Login failed.</div>
                <input type="text" placeholder="Username" class="input-large" id="username"><br/>
                <input type="password" placeholder="Password" class="input-large" id="password"><br/>
                <button type="submit" class="btn input-large">Login</button></br>
        </form>
    </div>

    <script>

    function login() {
        var tmp = {};
        tmp.user = $("#username").val();
        tmp.password = $("#password").val();

        sessionApi("login", tmp, function(data) {
            if (data.error) {
                $("#errorIndicator").show();
            } else {
                window.location.href = "index.php";
            }
        });
    }

    </script>

    <script src="lib/jquery-1.8.2.js"></script>
    <script src="lib/bootstrap/js/bootstrap.js"></script>
    <script src="javascript/session.js"></script>
  </body>
</html>