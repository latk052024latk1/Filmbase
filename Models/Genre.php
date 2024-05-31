<?php

namespace Models;
require_once '../vendor/autoload.php';

use PDO;

// This class represents the 'genres' table.

class Genre extends BaseModel
{

    private ?int $genre_id;
    private string $genre_name;
    private ?string $genre_desc;



    function __construct(){
        parent::__construct();
    }

    public function setId($genre_id){
        $this->genre_id = $genre_id;
    }

    public function getId(){
        return $this->genre_id;
    }

    public function setName($genre_name){
         $this->genre_name = $genre_name;
    }

    public function getName(){
        return $this->genre_name;
    }

    public function setDesc($genre_desc){
        $this->genre_desc = $genre_desc;
    }

    public function getDesc(){
        return $this->genre_desc;
    }

    public function selectAll(){
        $sql = "SELECT * FROM genres ORDER BY genre_name ASC";
        
        $stmt = $this->getDb()->connect()->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function selectOne(){ // Select a record based on the provided id.
        $sql = "SELECT * FROM genres WHERE genre_id = :g_id";

        $stmt = $this->getDb()->connect()->prepare($sql);
        $stmt->bindParam(":g_id", $this->genre_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function add(){ // Insert a record into the db.
        $sql_query = "INSERT INTO genres (genre_name, genre_desc) values (:g_name, :g_desc)";

        $stmt = $this->getDb()->connect()->prepare($sql_query);
        $stmt->bindParam(':g_name', $this->genre_name, PDO::PARAM_STR);
        $stmt->bindParam(':g_desc', $this->genre_desc, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function update(){ // Update the data.
        $sql_query = "UPDATE genres SET genre_name = :g_name, 
        genre_desc = :g_desc WHERE genre_id = :id";
        
        $stmt = $this->getDb()->connect()->prepare($sql_query);
        $stmt->bindParam(':g_name', $this->genre_name, PDO::PARAM_STR);
        $stmt->bindParam(':g_desc', $this->genre_desc, PDO::PARAM_STR);
        $stmt->bindParam(':id', $this->genre_id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function delete(){ // Delete a record based on the provided id.
        $sql_query = "DELETE FROM genres WHERE genre_id = :id";
        $stmt = $this->getDb()->connect()->prepare($sql_query);
        $stmt->bindParam(':id', $this->genre_id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function setAll($id, $name, $desc){
        $this->setId($id);
        $this->setName($name);
        $this->setDesc($desc);
    }

}

?>
