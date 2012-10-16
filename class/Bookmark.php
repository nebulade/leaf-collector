<?php

class Bookmark {
        private $bookmark_file;

        function __constructor($project) {
            $this->bookmark_file = $project->path() . "/" . "bookmarks.json";
        }

        public function add($name, $url) {
            $list = readJSONFromFile($this->bookmark_file);

            $list[] = array("name" => $name, "url" => $url);

            saveJSONToFile($list, $this->bookmark_file);
        }

        public function listAll() {
            return readJSONFromFile($this->bookmark_file);
        }
}

?>
