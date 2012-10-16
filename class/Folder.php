<?php

require_once("util.php");

class Folder {
    private $mPath = "";

    function __construct($path) {
        $this->mPath = $path;
    }

    public path() {
        return $this->mPath;
    }

    public function files() {
        $files = array();

        if (is_dir($this->mPath)) {
            if ($dh = opendir($this->mPath)) {
                while (($file = readdir($dh)) !== false) {
                    if (!is_dir($this->mPath . $file)) {
                        $files[] = array("name" => $file, "type" => filetype($this->mPath . $file));
                    }
                }
                closedir($dh);
            }
        }

        return $files;
    }

    public function folder() {
        $folder = array();

        if (is_dir($this->mPath)) {
            if ($dh = opendir($this->mPath)) {
                while (($file = readdir($dh)) !== false) {
                    if (is_dir($this->mPath . $file) && $file != "." && $file != "..") {
                        $folder[] = array("name" => $file, "type" => filetype($this->mPath . $file));
                    }
                }
                closedir($dh);
            }
        }

        return $folder;
    }
}

?>
