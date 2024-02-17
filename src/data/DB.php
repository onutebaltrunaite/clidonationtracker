<?php

class DB
{
    // Connection variables
    private $serverName = 'localhost';
    private $userName = 'root';
    private $password = '';
    private $databaseName = 'DonationsDB';

    // Connection variable
    public $conn;

    public function __construct()
    {
    }

    public function getConnection()
    {
        // Create connection
        $this->conn = new mysqli($this->serverName, $this->userName, $this->password);

        // Check connection
        if ($this->conn->connect_error) {
            die('Connection failed: ' . $this->conn->connect_error);
        }
    }

    public function selectDB()
    {
        //Check if db schema already exists
        $result = $this->conn->query("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$this->databaseName'");

        if ($result && $result->num_rows > 0) {
            $this->conn->select_db($this->databaseName);
            return true;
        }

        return false;
    }

    public function createDataBase()
    {
        // Create database if it doesn't exist
        $sql = "CREATE DATABASE IF NOT EXISTS $this->databaseName";
        if ($this->conn->query($sql) !== TRUE) {
            die("Error creating database: " . $this->conn->error);
        }
        echo "Database donationsDB created successfully. \n";
        $this->selectDB();

        $this->createCharityTable();
        $this->createDonationsTable();
    }

    private function createCharityTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS Charity(
            id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(30) NOT NULL,
            representative_email VARCHAR(30) NOT NULL
        )";

        $this->conn->query($sql);
        echo "Table Charity created successfully. \n";
    }

    private function createDonationsTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS Donations(
                id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                donor_name VARCHAR(100) NOT NULL,
                amount DECIMAL(10, 2) NOT NULL,
                charity_id INT UNSIGNED NOT NULL,
                time_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
				constraint fk_charity_id
    			foreign key(charity_id) 
        			references charity(id)
				ON DELETE CASCADE
    			ON UPDATE RESTRICT
            ) ENGINE = InnoDB;";

        $this->conn->query($sql);
        echo "Table Donations created successfully. \n";
    }

    // database close connection
    public function closeConn()
    {
        $this->conn->close();
    }
}
