<?php
class Database
{

    // put in the database credentials to connect the application to the database
    private $host = 'localhost';
    private $port = '3306';
    private $db_name = 'gamification';
    private $username = 'root';
    private $password = '';
    private $charset = 'utf8mb4';
    private $dsn;
    public $conn;

    public function connect()
    {
        $this->dsn = "mysql:host={$this->host};port={$this->port};dbname={$this->db_name};charset={$this->charset}";
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
