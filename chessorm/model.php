<?php
$host = 'localhost';
$port = '5432';
$dbname = 'chess_db';
$user = 'postgres';

//create a pdo instance

$pdo = new PDO("pgsql:host=".$host.";dbname=".$dbname."", $user);

function createClubsTable($pdo){
    $sql ='CREATE TABLE IF NOT EXISTS chessclubs (
                clubId   INTEGER PRIMARY KEY,
                clubName TEXT NOT NULL,
                clubAdress TEXT NOT NULL,
                clubDescrption TEXT NOT NULL
              )';
    $result = $pdo->exec($sql);
    return $result;
}

function createPlayersTable($pdo){
    $sql ='CREATE TABLE IF NOT EXISTS players (
                playerId   INTEGER PRIMARY KEY ,
                clubId   INTEGER NOT NULL,
                firstName TEXT NOT NULL,
                lastName TEXT NOT NULL,
                emailAdress TEXT NOT NULL,
                country TEXT NOT NULL
              )';
    $result = $pdo->exec($sql);
    return $result;
}

function createRankTable($pdo){
    $sql ='CREATE TABLE IF NOT EXISTS playerRank (
                playerId   INTEGER PRIMARY KEY ,
                playerRating INTEGER NOT NULL,
                playerRank TEXT NOT NULL
              )';
    $result = $pdo->exec($sql);
    return $result;
}

function createMatchesTable($pdo){
    $sql ='CREATE TABLE IF NOT EXISTS matches (
                matchId   INTEGER PRIMARY KEY,
                player1Id INTEGER NOT NULL,
                player2Id INTEGER NOT NULL,
                matchDate date NOT NULL,
                result TEXT NOT NULL,
                matchType TEXT NOT NULL
              )';
    $result = $pdo->exec($sql);
    return $result;
}

function insertInTable($table, $data, $pdo){
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
    $result = $pdo->prepare($sql);
    foreach ($data as $atribute => $atributeValue){
        $result->bindParam(':'.$atribute, $data[$atribute]);
    }
    $result->execute();
    return $result;
}

function deleteFromTable($table, $parameter, $valueParameter, $pdo){
    $sql = "DELETE FROM $table WHERE $parameter =  :$parameter";
    $result = $pdo->prepare($sql);
    $result->bindParam(':'.$parameter , $valueParameter);
    $result->execute();
    return $result;
}

function UpdateTable ($table, $data, $parameter, $valueParameter, $pdo){
    $updatesql ='';
    foreach ($data as $atribute => $atributeValue){
        $updatesql .= $atribute .' =:'.$atribute. ' ,';
    }
    $updatesql = mb_substr($updatesql, 0, -1);
    $sql = "UPDATE $table SET $updatesql
            WHERE $parameter = :$parameter";
    $result = $pdo->prepare($sql);
    foreach ($data as $atribute => $atributeValue){
        $result->bindParam(':'.$atribute, $data[$atribute]);
    }
    $result->bindParam(':'.$parameter, $valueParameter);

    $result->execute();
    return $result;
}

function SelectAllData($table, $pdo){
    $sql = 'SELECT * FROM players';
    $result = $pdo->prepare($sql);
    $result->execute();
    $red = $result->fetchAll();
    return ($red);
}

function findPlayerWithRank($pdo, $minRank, $maxRank){
    $sql = 'SELECT players.firstname, playerrank.playerrank
        FROM players
        INNER JOIN playerrank
        ON players.playerid = playerrank.playerid WHERE playerrating < :maxRank and playerrating > :minRank';
    $result = $pdo->prepare($sql);
    $result->bindParam(':minRank', $minRank);
    $result->bindParam(':maxRank', $maxRank);
    $result->execute();
    $red = $result->fetchAll();
    return($red);
}

if (isset($_POST['operation'])){
    switch ($_POST['operation']){
        case 'Insert':
            $data= [
                'playerid' => '12',
                'clubid' => '33',
                'firstname' => 'wq',
                'lastname' => 'ccqc',
                'emailadress' => 'cqwqcc',
                'country' => 'ccc'
            ];
            insertInTable('players', $data, $pdo);
            break;
        case 'Update':
            $data= [
                'playerid' => '12',
                'clubid' => '33',
                'firstname' => 'wq',
                'lastname' => 'ccqc',
                'emailadress' => 'cqwqcc',
            ];
            UpdateTable ('players', $data, 'country', 'ccc', $pdo);
            break;
        case 'Delete':
            deleteFromTable('players', 'country', 'ccc', $pdo);
            break;
        case 'Show':
            $data = SelectAllData($_POST['table'], $pdo);
            echo(json_encode($data));
            break;
        case 'findDiap':
            $data = findPlayerWithRank($pdo, $_POST['maxRank'],$_POST['minRank'] );
            echo(json_encode($data));
            break;
    }
}

?>