<?php

class Sql extends PDO {

    private $conn;

    public function __construct()
    {

        $this->conn = new PDO("mysql:dbname=dpphp7;host=localhost", "root", "");

    }

    private function setParams($statment, $parameters = array())
    {
        foreach ($parameters as $key => $value)
        {

            $this->setParam($statment, $key, $value);

        }

    }

    private function setParam($statment, $key,$value)
    {

        $statment->bindParam($key,$value);

    }

    public function query($rawQuery, $params = array())
    {
        $stmt = $this->conn->prepare($rawQuery); //prepara a linha 

        $this->setParams($stmt,$params);

        $stmt->execute();

        return $stmt;

    }
   //$rawQuery recebe a linha , $paramns recebe um array de parametros
    public function select($rawQuery, $params = array())
    {

        $stmt = $this->query($rawQuery, $params);

        return $stmt->fetchAll(PDO ::FETCH_ASSOC); //retorna um array simples 

    }

}