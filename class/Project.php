<?php

require_once("util.php");

class Project {
    public function select($name) {
        if ($name == "")
            return false;

        $_SESSION["project"] = $name;

        return true;
    }

    public function listAll() {
        $projects = array();
        $dir = "store/";

        if (is_dir($dir)) {
            if ($dh = opendir($dir)) {
                while (($file = readdir($dh)) !== false) {
                    if (is_dir($dir . $file) && $file != "." && $file != "..") {
                        $projects[] = array("name" => $file, "type" => filetype($dir . $file));
                    }
                }
                closedir($dh);
            }
        }

        return $projects;
    }

    public function currentProject() {
        if (isset($_SESSION["project"]))
            return $_SESSION["project"];
        else
            return "";
    }
}

?>
