<?php

namespace Controllers;
require_once '../vendor/autoload.php';

use PDO;
use Models;

class TagController extends BaseController
{

    
    function __construct()
    {
        parent::__construct(new Models\Tag());
    }

    public function add(){ // Add a record to the database table.
        if (isset($_POST["name"])){

                $this->getModel()->setAll(NULL, $_POST["name"]);
                $this->getModel()->add();
            }
            include_once "../src/Views/AddTag.html";
    }
    
    public function update($id){ // Update a record.
        if (isset($_POST["name"])){
                
                $this->getModel()->setAll($id, $_POST["name"]);
                $this->getModel()->update();
            }
    }
    public function delete($id){ // Delete a record.
        if (isset($id)){

            $this->getModel()->setId($id);
            $this->getModel()->delete();
        }
    }

    public function addByEntity($id){ // Add a record to a pivot table.

        if (isset($_POST["tagName"])){
            $this->getModel()->setName($_POST["tagName"]);
            $tag = $this->getModel()->selectByName();

            if ($tag){
                $tag_id = $tag["tag_id"];
                $this->getModel()->setId($tag_id);
        
                $this->getModel()->addByEntity($id);
            }
        }
        
        else{
            return false;
            }
    }

    public function selectByEntity($id){ // Select a record by entity_id;
        return $this->getModel()->selectByEntity($id);
    }
    
}

?>