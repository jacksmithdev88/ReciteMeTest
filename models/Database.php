<?php

class Database
{
    private $user = 'root';
    private $password = '';
    private $db_name = 'ReciteMe';
    private $host = 'localhost';
    private $query;
    private $connection;

    public function __construct()
    {
        try {
            $this->connection = new PDO("mysql:host=$this->host;dbname=$this->db_name", $this->user, $this->password);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function prepare($stmt)
    {
        $this->query = $this->connection->prepare($stmt);
    }

    public function execute()
    {
        return $this->query->execute();
    }

    public function fetch()
    {
        $this->query->execute();
        return $this->query->fetchAll(PDO::FETCH_ASSOC) ;
    }

    public function createDataTable()
    {
        try {
            $this->prepare('CREATE TABLE `posts` (
                `title` varchar(255),
                `author` varchar(255),
                `url` varchar(255)
            );');
            $this->execute();
            return true;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function dropData()
    {
        try {
            $this->prepare('TRUNCATE TABLE `posts`;');
            $this->execute();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function checkTable()
    {
        $this->query = $this->connection->prepare("DESCRIBE `posts`");
        if (!$this->query->execute()) {
            $this->createDataTable();
            return false;
        } else {
            return true;
        }
    }
}
