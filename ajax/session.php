<?php

set_include_path("../");

require_once("util.php");

if ($action == "logout") {
    session_start();
    session_destroy();

    callback(0,0);
} elseif ($action == "login") {
    $data = json_decode($payload, true);
    $user = $data["user"];
    $password = $data["password"];

    if ($user == "jzellner") {
        session_start();

        $_SESSION["user"] = $user;
        callback(false, "");
    } else {
        callback(true, "Invalid username/password");
    }
}

?>