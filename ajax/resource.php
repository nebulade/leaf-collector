<?php

require("util.php");

$bookmarks = new Bookmarks();

if ($action == "list") {
    $bookmarks->listAll();
} elseif ($action == "add") {
    $data = json_decode($payload, true);
    $bookmarks->add($data["name"], $data["url"]);
} else {
    callback(1, NULL);
}

?>
