<?php

class Database
{
    public $connection;

    public function __construct($config, $username = "root", $password = "admin")
    {
        $dsn = "mysql:" . http_build_query($config["database"], "", ";");

        $this->connection = new PDO($dsn, $username, $password, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }

    public function query($statement, $params = []) {
        $statement = $this->connection->prepare($statement);
        $statement->execute($params);

        return $statement;
    }
}