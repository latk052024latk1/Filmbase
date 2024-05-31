<?php

namespace Controllers;
require_once '../vendor/autoload.php';

use PDO;
use Models;

class SearchController extends BaseController
{
    
    function __construct()
    {
        parent::__construct(new Models\Search());
    }

    public function search(){ // This function is used to implement a simple search stuff. 
                              // When the server receives a query and a type of the records it should return, 
                              // the function selects data either from the 'entities' table or from the 'people' table.
        session_start();
        $this->isSession();

        if (isset($_POST["query"], $_POST["category"])){
            
            $results = [];
            
            if ($_POST["category"] === "entities"){
                $entities = new Models\Entity();
                $results = $entities->searchEntity($_POST["query"]);

            }
            elseif ($_POST["category"] === "people"){
                $people = new Models\Person();
                $results = $people->searchPerson($_POST["query"]);
            }
            $_SESSION["results"] = $results;
            $_SESSION["category"] = $_POST["category"];
          #  var_dump($results);
        }
        #return $this->getModel()->selectByEntity($id);
        include_once "../src/Views/Search.php";
    }

    public function home(){ // This function is used to return the Home.php view.
        $entity = new EntityController();
        $entities = $entity->showLast();

        include_once "../src/Views/Home.php";
    }
}


?>