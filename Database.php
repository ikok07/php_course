<?php

class Database
{
    public $connection;
    public $statement;

    public function __construct($config, $username = "root", $password = "admin")
    {
        $dsn = "mysql:" . http_build_query($config["database"], "", ";");

        $this->connection = new PDO($dsn, $username, $password, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }

    public function query($statement, $params = []) {
        $this->statement = $this->connection->prepare($statement);
        $this->statement->execute($params);

        return $this;
    }

    public function get() {
        return $this->statement->fetchAll();
    }

    public function find() {
        return $this->statement->fetch();
    }

    public function findOrFail($status_code = 404) {
        $result = $this->find();
        if (!$result) abort($status_code);

        return $result;
    }
}