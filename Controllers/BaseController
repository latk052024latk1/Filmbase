<?php

namespace Controllers;
require_once __DIR__ . '/../../vendor/autoload.php';

use PDO;
use Models;

// This abstract class is extended by each of controller classes.

abstract class BaseController
{
    protected $model;

    function __construct($model){
        $this->model = $model;
    }

    public function getModel() 
    {
        return $this->model;
    }
    
    protected function isSession(){ // This function checks if there is any username in a session array 
                                    // and, if it's not found, redirects a person to the login page.
        if (!isset($_SESSION["username"])){
            header("Location:../login/");
        }       
    }

    protected function isSessionFromAdmin(){ // This function does literally the same, 
                                             // but redirects a person from an admin page.
        if (!isset($_SESSION["username"])){
            header("Location:../../login/");
        }
    }
    protected function isAdmin(){ // This function checks, if a user has rights to access admin pages (dashboard).
        $u = new Models\User();
  
        $u->setName($_SESSION["username"]);
        $user_data = $u->selectOne();
        $role = $user_data["role"];
        if ($role > 1){
            header("Location:../../../home/");
        }
    }
}


?>
