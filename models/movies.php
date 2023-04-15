<?php
$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__) . $ds . '..') . $ds;

require_once("{$base_dir}includes{$ds}Database.php");

class Movies{
    private $table = 'movie';
    public $id;
    public $names;
    public $overview;
    public $original_language;
   

    public function __construct() {}

    public function validate_params($value) {
        if(!empty($value)) {
            return true;
        } else {
            return false;
        }
    }

  
    public function get_movies(){
        global $database;
        $sql = "SELECT DISTINCT name, overview FROM {$this->table} WHERE `original_language` LIKE 'en'";
        $result = $database->query($sql);
        return $database->fetch_array($result);
    }
}

// create object
$movie = new Movies();
