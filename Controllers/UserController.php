<?php

namespace Controllers;
require_once '../vendor/autoload.php';

use Exception;
use PDO;
use Models;
class UserController extends BaseController
{

    protected $model;
    function __construct()
    {
        parent::__construct(new Models\User());
    }


    public function user_list() // Show a list of records.
    {
        session_start();
        $this->isSession();
        $this->getModel()->selectAll();
    }

    public function showOne($id){ // Show one record.
        session_start();
        $this->isSession();
        $this->getModel()->setId($id);
        $user_data = $this->getModel()->selectOneId();

        $reviews = new ReviewController();
        $review_top = $reviews->show_last($id);
        
        include_once "../src/Views/PageUser.html";
    }

    public function showAllReviews($id){ // Show all the reviews written by a certain user.
        session_start();
        $this->isSession();
        $this->getModel()->setId($id);
        $user_data = $this->getModel()->selectOneId();

        $reviews = new ReviewController();
        $review_top = $reviews->show_all_by_user($id);
        
        include_once "../src/Views/ListReviewUser.php";
    }

    public function editReview($id, $reviewid) // Edit a review.
    {
        session_start();
        $this->isSession();
        $this->getModel()->setId($id);

        $review_control = new ReviewController();        
        $review_old = $review_control->show_one($reviewid);
        $review_control->edit_review($reviewid);

        include_once "../src/Views/EditReviewUser.php";

    }

    public function add() // Add a record to the db table.
    {
        session_start();
        $this->isSession();
        if (isset($_POST['username'], $_POST['password'])) {
            $this->all_setters();

            if ($_POST["password"] == $_POST["password_repeat"]) {
                $this->getModel()->add();
            }
            else {
                return false;
            }
        }
    }

    public function user_update($id) // Update user's data.
    {
        session_start();
        $this->isSession();

        if (isset($_POST['old_password']) && isset($_POST["new_password"])) {
            $this->getModel()->setId($_SESSION["user_id"]);
            $user_data = $this->getModel()->selectOneId($id);

            if (password_verify($_POST["old_password"], $user_data["user_password"])){
                $new_password = password_hash($_POST["new_password"], PASSWORD_DEFAULT);
                $this->getModel()->setPassword($new_password);
            
                try{
                    $this->getModel()->update();
                    header("Location:../../logout/");

            }
                catch(Exception $e){
                    echo $e->getMessage();
                }
            }
        }
        include_once "../src/Views/EditUser.php";
    }

    public function user_delete($id) // Delete user's data.
    {
        session_start();
        $this->isSession();
        $this->getModel()->setId($id);
        $this->getModel()->delete();
    }

    public function user_login()
    {
        if (isset($_SESSION["username"])){
            session_start();

            header("Location:../users/".$_SESSION["user_id"]);
        }
        else{
            if (isset($_POST['username']) && isset($_POST['password'])) {
                $this->getModel()->setName($_POST["username"]);
                $this->getModel()->setPassword($_POST["password"]);
                $user_data = $this->getModel()->selectOne($_POST['username']);
                
                if (password_verify($_POST['password'],  $user_data["user_password"])){                
                    session_start();
                    $_SESSION["username"] = $_POST['username'];
                    $_SESSION["user_id"] = $user_data['user_id'];
                    $i = intval($_SESSION["user_id"]);
                    $_SESSION["role"] = $user_data["role"];
               
                    header("Location:../users/".$i);
                }
                else {
                    return false;
                }
            }
        }
        include_once "../src/Views/Login.html";
    

    }

    public function user_logout(){ // Handle logout.
        session_destroy();
        header("Location:../login/");
    }

    public function user_register() // Handle registration.
    {
        session_start();
        if (isset($_SESSION["username"])){
            session_destroy();
            header("Location:../registration/");
        }
        else{
            if (isset($_POST['username'], $_POST["email"], $_POST['password'])) {
                
                $this->getModel()->setAll(NULL, $_POST["username"], $_POST["password"], $_POST["email"]);

                $this->getModel()->add();
                header("Location:../login/");
            }
            else {
                return false;
            }
        }
        
        include_once "../src/Views/Register.html";
    }

}

?>