<?php

function get($name) {
    if (isset($_POST[$name]))
        return $_POST[$name];
    elseif (isset($_GET[$name]))
        return $_GET[$name];
    else
        return "";
}

function callback($error, $result) {
    $ret["error"] = $error;
    $ret["result"] = $result;
    echo json_encode($ret);
}

$action = get('action');
$payload = get('payload');

function readJSONFromFile($filename) {
    $file = fopen($filename, "r");

    $content = "";
    $buffer = "";

    while ($buffer = fread($file, 256)) {
        $content .= $buffer;
    }

    fclose($file);

    return json_decode($content);
}

function saveJSONToFile($object, $filename) {
    $file = fopen($filename, "w");

    fwrite($file, json_encode($object));
}


// User related
function getUser() {
    if (isset($_SESSION["user"]))
        return $_SESSION["user"];
    else
        return "";
}

?>