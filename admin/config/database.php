<?php
class Database
{

    // put in the database credentials to connect the application to the database
    private $host = 'db'; // service name from docker-compose.yml
    private $db_name = 'gamification';
    private $username = 'user'; // matches MYSQL_USER
    private $password = 'password'; // matches MYSQL_PASSWORD
    private $charset = 'utf8mb4';

    private $dsn;
    public $conn;

    public function connect()
    {
        $this->dsn = "mysql:host={$this->host};dbname={$this->db_name};charset={$this->charset}";

        try {
            $this->conn = new PDO($this->dsn, $this->username, $this->password);
            // Set the PDO error mode to exception
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
        } catch (PDOException $e) {
           
            echo "Connection failed: " . $e->getMessage();
        }
        return $this->conn;
    }

    public function closeConnection() {
        $this->conn = null;
    }
}

?>
