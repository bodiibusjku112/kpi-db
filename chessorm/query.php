<?php

class Query
{
    private  $host = 'localhost';
    private  $port = '5432';
    private  $dbname = 'chess_db';
    private  $user = 'postgres';

    private $pdo;

    function __construct()
    {
        $pdo = new PDO("pgsql:host=".$this->host.";dbname=".$this->dbname."", $this->user);
        $this->pdo = $pdo;
    }

    public function insertInTable($table, $data){
        $insertsql = '';
        $insertsqlval = '';
        foreach ($data as $atribute => $atributeValue){
            $insertsql .= $atribute. ' ,';
            $insertsqlval .=':'.$atribute. ' ,';
        }
        $insertsql = mb_substr($insertsql, 0, -1);
        $insertsqlval = mb_substr($insertsqlval, 0, -1);

        $sql = "INSERT INTO $table ($insertsql)
            VALUES ($insertsqlval)";
        $result = $this->pdo->prepare($sql);
        foreach ($data as $atribute => $atributeValue){
            $result->bindParam(':'.$atribute, $data[$atribute]);
        }
        $result->execute();
        return $result;
    }

    public function deleteFromTable($table, $parameter, $valueParameter){
        $sql = "DELETE FROM $table WHERE $parameter =  :$parameter";
        $result = $this->pdo->prepare($sql);
        $result->bindParam(':'.$parameter , $valueParameter);
        $result->execute();
        return $result;
    }

    public function UpdateTable ($table, $data, $parameter, $valueParameter ){
        $updatesql ='';
        foreach ($data as $atribute => $atributeValue){
            $updatesql .= $atribute .' =:'.$atribute. ' ,';
        }
        $updatesql = mb_substr($updatesql, 0, -1);
        $sql = "UPDATE $table SET $updatesql
            WHERE $parameter = :$parameter";
        $result = $this->pdo->prepare($sql);
        foreach ($data as $atribute => $atributeValue){
            $result->bindParam(':'.$atribute, $data[$atribute]);
        }
        $result->bindParam(':'.$parameter, $valueParameter);

        $result->execute();
        return $result;
    }

    public function SelectAllData($table){
        $sql = 'SELECT * FROM $table';
        $result = $this->pdo->prepare($sql);
        $result->execute();
        $red = $result->fetchAll();
        return ($red);
    }

    public function SelectData($table, $parameter, $valueParameter){
        $sql = "SELECT * FROM $table WHERE $parameter = :$parameter";
        $result = $this->pdo->prepare($sql);
        $result->bindParam(':'.$parameter, $valueParameter);
        $result->execute();
        $red = $result->fetchAll();
        return ($red[0]);
    }
}