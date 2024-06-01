<?php
namespace Models;
// header("Access-Control-Allow-Origin: *");
use PDO;

// Database class  is used to define database credentials and to establish connection with the MySQL database.

class Database
{
    protected string $db_servername = 'localhost';
    protected string $db_user = 'root';
    protected string $db_pass = '';
    protected string $db_name = 'filmbase2';

    protected $pdo;

    // This function establishes the connection with the db using PDO.

    public function connect() {
        try {
            $dsn = "mysql:host={$this->db_servername};dbname={$this->db_name}";
            $this->pdo = new PDO($dsn, $this->db_user, $this->db_pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $this->pdo;
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }
}

