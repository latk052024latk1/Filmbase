<?php

namespace Models;
require_once '../vendor/autoload.php';

use PDO;

class User extends BaseModel
{

	private ?int $user_id;
	private string $username;
	private string $user_password;
    private int $role;
	private string $email;
	private string $date_joined;
 

	function __construct(){
		parent::__construct();
        
        $this->role = 2;
	}

	public function setId($user_id){
		$this->user_id = $user_id;
	}

	public function getId(){

		return $this->user_id;
	}

	public function setName($username){
		$this->username = $username;
	}

	public function getName(){

		return $this->username;
	}

	public function setPassword($user_password){
		$this->user_password = password_hash($user_password, PASSWORD_DEFAULT);
	}

	public function getPassword(){

		return $this->user_password;
	}

	public function setEmail($email){
		$this->email = $email;
	}

	public function getEmail(){
		return $this->email;
	}

	public function setDate(){
		$this->date_joined = date("Y-m-d H:i:s");
	}

	public function getDate(){
		return $this->date_joined;
	}


	public function add(){ // Insert a record.
        $sql_query = "INSERT INTO users (username, user_password, role, email, date_joined) 
                      values (:username, :user_password, :role, :email, :date_joined)";
        
        $stmt = $this->getDb()->connect()->prepare($sql_query);

        $stmt->bindParam(':username', $this->username, PDO::PARAM_STR);
        $stmt->bindParam(':user_password', $this->user_password, PDO::PARAM_STR);
        $stmt->bindParam(':role', $this->role, PDO::PARAM_INT);
        $stmt->bindParam(':email', $this->email, PDO::PARAM_STR);
        $stmt->bindParam(':date_joined', $this->date_joined, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function update(){ // Update a record.
        $sql_query = "UPDATE users SET
        user_password = :user_password WHERE user_id = :user_id";

        $stmt = $this->getDb()->connect()->prepare($sql_query);

        $stmt->bindParam(':user_id', $this->user_id, PDO::PARAM_INT);
        $stmt->bindParam(':user_password', $this->user_password, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function delete(){ // Delete a record.
        $sql_query = "DELETE FROM users WHERE user_id = :user_id";

        $stmt = $this->getDb()->connect()->prepare($sql_query);

        $stmt->bindParam(':user_id', $this->user_id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function selectAll(){ // Select all the records.
        $sql_query = "SELECT * FROM users ORDER BY date_joined DESC";
        
        $stmt =  $this->getDb()->connect()->query($sql_query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function selectOne(){ // Select a record by username.
        $sql_query = "SELECT * FROM users WHERE username = :username";

        $stmt =  $this->getDb()->connect()->prepare($sql_query);

        $stmt->bindParam(':username', $this->username, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }    
    public function selectOneId(){ // Select a record by id.
        $sql_query = "SELECT * FROM users WHERE user_id = :u_id";

        $stmt =  $this->getDb()->connect()->prepare($sql_query);
        $stmt->bindParam(':u_id', $this->user_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }  

    public function setAll($id, $name, $password, $email){
        $this->setId($id);
        $this->setName($name);
        $this->setPassword($password);
        $this->setEmail($email);
        $this->setDate();
    }


    public function check($username, $password){ // Verification of user's credentials.
        $this->setName($username);
        $user_data = $this->selectOne();   
        $pass = $user_data["user_password"];
        return $pass;
    }

}

?>
