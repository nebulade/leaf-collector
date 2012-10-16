<?php

set_include_path("../");

require_once("guard.php");
require_once("util.php");
require_once("class/Project.php");

if ($action == "select") {
    $data = json_decode($payload, true);
    $result = false;
    if (isset($data["name"])) {
        $project = new Project();
        $result = $project->select($data["name"]);
    }
    callback($result, $data["name"]);
} elseif ($action == "create") {

} elseif ($action == "delete") {

} elseif ($action == "listAll") {
    callback(false, listAll());
}

?>
