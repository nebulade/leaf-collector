<?php

require_once("session.php");

?>

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
          <div class="nav-collapse collapse">
            <p class="navbar-text pull-right">
              Logged in as <a href="#" class="navbar-link">Username</a>
            </p>
            <ul class="nav">
              <li><a href="#">Current Project</a></li>
              <li>
              <div class="btn-group">
                <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                DMX Dongle
                <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li><a tabindex="-1" href="#">DMX Dongle</a></li>
                    <li><a tabindex="1" href="#">Flash555</a></li>
                </ul>
                </div></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span3">
          <div class="well sidebar-nav">
            <ul class="nav nav-list">
              <li class="nav-header">Views</li>
              <li class="active"><a href="#">Files</a></li>
              <li><a href="#">Bookmarks</a></li>
              <li><a href="#">Tasks</a></li>
              <li><a href="#">Notes</a></li>
              <li><a href="#">Project</a></li>
              <li class="nav-header">Actions</li>
              <li><a href="#">User defined</a></li>
            </ul>
          </div><!--/.well -->
        </div><!--/span-->
        <div class="span9">

        </div><!--/span-->
      </div><!--/row-->

      <hr>

      <footer>
        <p>&copy; Nebulon 2012</p>
      </footer>

    </div><!--/.fluid-container-->

    <script src="lib/jquery-1.8.2.js"></script>
    <script src="lib/bootstrap/js/bootstrap.js"></script>
  </body>
</html>