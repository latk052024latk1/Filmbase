<?php

namespace Controllers;
require_once '../vendor/autoload.php';

use PDO;
use Models;

class CharacterController extends BaseController
{

    
    function __construct()
    {
        parent::__construct(new Models\Character());
    }

    public function showAll($id){ // Show a list of records.
        $this->isSession();
        return $this->getModel()->selectByEntity($id);
    }

    public function showOne($id){ // Show one record.
        session_start();
        $this->isSession();
        $this->getModel()->setId($id);

        $character_data = $this->getModel()->selectOne();
        return $character_data;
    }

    public function add($entity_id){ // Create a new record.
        $this->isSession();
        if (isset($_POST["actorId"], $_POST["character_name"])){

            $this->getModel()->setAll(NULL, $entity_id, $_POST["character_name"], $_POST["actorId"]);
            return $this->getModel()->add();
        }                
        else {
            return json_encode(array("Status"=>"Bad"));
        }
    }

    public function update($id){ // Edit a record.
        session_start();
        $this->isSession();
        if (isset($_POST["name"])){
                
                $this->getModel()->setAll($id, $_POST["name"]);
                $this->getModel()->update();
            }
    }
    
    public function delete($id){
        session_start();
        $this->isSession();
        
        $this->getModel()->setId($id);
        $this->getModel()->delete();
            
    }

    public function selectByEntity($entity_id){
        return $this->getModel()->selectByEntity($entity_id);
    }

}

?>