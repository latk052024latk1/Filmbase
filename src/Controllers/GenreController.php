<?php

namespace Controllers;
require_once __DIR__ . '/../../vendor/autoload.php';

use PDO;
use Models;

class GenreController extends BaseController
{
  
    function __construct()
    {
        parent::__construct(new Models\Genre());
    }

    public function showAll(){ // Show a list of records.
        session_start();
        $this->isSession();
        $this->isAdmin();
        $genres = $this->getModel()->selectAll();
        include_once "../src/Views/ListGenre.html";
    }

    public function showOne($id){ // Show a record.
        session_start();
        $this->isSessionFromAdmin();
        $this->isAdmin();
        $this->getModel()->setId($id);
        $genre_data = $this->getModel()->selectOne();
        
        $entity = new Models\Entity();
        $entity->setGenre($id);
        $number = $entity->countByGenre();

        include_once "../src/Views/PageGenre.html";
    }

    public function add(){ // Add a record.
        session_start();
        $this->isSessionFromAdmin();
        $this->isAdmin();
        if (isset($_POST["name"]) && isset($_POST["desc"])){

            $this->getModel()->setAll(NULL, $_POST["name"], $_POST["desc"]);

            $this->getModel()->add();
            echo "Data added successfully!";        
        }
        include_once "../src/Views/AddGenre.html";
    }
    public function update($id){ // Update a record.
        session_start();
        $this->isSessionFromAdmin();
        $this->isAdmin();
        if (isset($id) && isset($_POST["name"]) && isset($_POST["desc"])){
                
            $this->getModel()->setAll($id, $_POST["name"], $_POST["desc"]);
            $this->getModel()->update();
        }
        include_once "../src/Views/UpdateGenre.html";
    }

    public function delete($id){ // Delete a record.
        session_start();
        $this->isSessionFromAdmin();
        $this->isAdmin();
        if (isset($id)){
            $this->getModel()->setId($id);
            $this->getModel()->delete();
        }
    }

}

?>