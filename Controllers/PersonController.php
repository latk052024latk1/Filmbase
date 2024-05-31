<?php

namespace Controllers;
require_once __DIR__ . '/../../vendor/autoload.php';

use PDO;
use Models;


class PersonController extends BaseController
{

    function __construct()
    {
        parent::__construct(new Models\Person());

    }

    public function showAll(){ // Show a list of records.
        session_start();
        $this->isSession();

        $people = $this->getModel()->selectAll();
        include_once "../src/Views/ListPerson.html";
    }

    public function showOne($id){ // Show a record.
        session_start();
        $this->isSession();

        $this->getModel()->setId($id);
        $people_data = $this->getModel()->selectOne();
        include_once "../src/Views/PagePersonShow.php";
    }

    public function showOneAdmin($id){ // Show a record on the admin dashboard.
        session_start();
        $this->isSession();
        $this->isAdmin();

        $this->getModel()->setId($id);
        $people_data = $this->getModel()->selectOne();

        $country = new CountryController();
        $countries_by = $country->selectByPerson($id);

        $countries_list = $country->getModel()->selectAll();
        $country->addByPerson($id);


        include_once "../src/Views/PagePerson.html";

    }

    public function add(){ // Add a record and then update the file path.
        session_start();
        $this->isSession();
        $this->isAdmin();

        if (isset($_POST["name"], $_POST["surname"], $_POST["gender"])){
                
            $this->getModel()->setAll(NULL, $_POST["name"], 
                $_POST["surname"], $_POST["gender"], 
                $_POST["birth_date"], $_POST["death_date"]);

            $id = $this->getModel()->add();
            $this->getModel()->setId($id);
                
            $file = $this->getModel()->file_handling($this->getModel()->getId());                
            $this->getModel()->updateWithImage($file);
        }
        
        include_once "../src/Views/AddPerson.html";
    }

    public function update($id){
        session_start();
        $this->isSession();
        $this->isAdmin();

        if (isset($_POST["name"], $_POST["surname"], $_POST["gender"])){
                
            $this->getModel()->setAll($id, $_POST["name"], $_POST["surname"], 
                $_POST["gender"], $_POST["birth_date"], $_POST["death_date"]);

            $this->getModel()->update();
        }
    }
    public function delete($id){
        session_start();
        $this->isSession();
        $this->isAdmin();

        $this->getModel()->setId($id);
        $result = $this->getModel()->selectOne();

        unlink($result["photo"]);
        $this->getModel()->delete();
    }

}
?>