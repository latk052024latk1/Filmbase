<?php

namespace Controllers;
require_once '../vendor/autoload.php';

use PDO;
use Models;

class ProfessionController extends BaseController
{

    
    function __construct()
    {
        parent::__construct(new Models\Profession());
    }


    public function showAll(){ // Show a list of records.
        session_start();
        $this->isSessionFromAdmin();
        $this->isAdmin();
        $professions = $this->getModel()->selectAll();
        include_once "../src/Views/ListProfession.html";
    }

    public function showOne($id){ // Show one record.
        session_start();
        $this->isSessionFromAdmin();
        $this->isAdmin();
        $this->getModel()->setId($id);
        $profession_data = $this->getModel()->selectOne();
        $number = $this->getModel()->countPeople();
        include_once "../src/Views/PageProfession.php";

    }

    public function add(){ // Add a record to the database table.
        session_start();
        $this->isSessionFromAdmin();
        $this->isAdmin();
        if (isset($_POST["profession_name"])){

            $this->getModel()->setAll(NULL, $_POST["profession_name"], 
                                            $_POST["profession_desc"]);
            $this->getModel()->add();
        }
        include_once "../src/Views/AddProfession.html";
    }

    public function update(){ // Update a record.
        session_start();
        $this->isSessionFromAdmin();
        $this->isAdmin();
        if (isset($_GET["id"], $_POST["name"], $_POST["desc"])){
                
            $this->getModel()->setAll($_GET["id"], $_POST["name"], 
                                                   $_POST["desc"]);

            $this->getModel()->update();
        }
    }
    
    public function delete(){ // Delete a record.
        session_start();
        $this->isSessionFromAdmin();
        $this->isAdmin();
        if (isset($_GET["id"])){
                $this->getModel()->setId($_GET["id"]);
                $this->getModel()->delete();
        }
    }

}

?>