<?php
include 'query.php';
class players
{
    static $table = 'players';
    public $playerid;
    public $clubid ;
    public $firstname ;
    public $lastname ;
    public $emailadress ;
    public $country ;

    function __construct($playerId, $pdo){
        $atributes = $pdo->SelectData(self::$table, 'playerid' ,$playerId );
        $this->playerid = $playerId;
        $this->clubid = $atributes['clubid'];
        $this->firstname = $atributes['firstname'];
        $this->lastname = $atributes['lastname'];
        $this->emailadress = $atributes['emailadress'];
        $this->country = $atributes['country'];
    }

    static function addPlayer($data, $pdo){
        $result = $pdo->insertInTable(self::$table, $data);
        return $result;
    }

    static function deletePlayer($parameter, $valueParameter,  $pdo){
        $result = $pdo->deleteFromTable(self::$table, $parameter, $valueParameter);
        return $result;
    }

    static function updatePlayer($parameter, $data, $valueParameter,  $pdo){
        $result = $pdo->UpdateTable(self::$table, $data, $parameter, $valueParameter);
        return $result;
    }
}
