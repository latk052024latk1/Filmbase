<?php
namespace Models;
require_once "Database.php";

// An abstract class that will be extended by each of other Model classes.

abstract class BaseModel
{
    protected $db;

    function __construct(){
        $this->db = new Database(); // When it's used, connection with the database is established.
    }

    /**
     * @return Database
     */
    public function getDb(): Database
    {
        return $this->db;
    }
 
}
