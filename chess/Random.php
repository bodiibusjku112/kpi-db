<?php
$host = 'localhost';
$port = '5432';
$dbname = 'chess_db';
$user = 'postgres';

//create a pdo instance
$pdo = new PDO("pgsql:host=".$host.";dbname=".$dbname."", $user);

$firstname = ['Bodya', 'Stepa', 'Misha', 'Nina', 'Liza', 'Sanya', 'Vadim', 'Olya', 'Lilia', 'Ser_gay', 'Donald'];
$lastname = ['Bodyanich', 'Stepanich', 'Mishin', 'Ninasiv', 'Lizin', 'Sanich', 'Vadimich', 'Olyasha', 'Lilianich', 'Ser_gayevich', 'Donaldisimmo'];
$emailadress = ['Bodyanich@gmail.ru', 'Stepanich@gmail.ru', 'Mishin@gmail.ru', 'Ninasiv@gmail.ru', 'Lizin@gmail.ru', 'Sanich@gmail.ru', 'Vadimich@gmail.ru', 'Olyasha@gmail.ru', 'Lilianich@gmail.ru', 'Ser_gayevich@gmail.ru', 'Donaldisimmo@gmail.ru'];
$country = ['ru', 'Ua', 'Uzb', 'Kz', 'Eng', 'Fr', 'Pl', 'Br', 'Italia', 'Esp', 'Col'];

$data= [
    'playerid' => rand(1, 267),
    'clubid' => rand(1, 267),
    'firstname' => $firstname[rand(1, 10)],
    'lastname' => $lastname[rand(1, 10)],
    'emailadress' => $emailadress[rand(1, 10)],
    'country' => $country[rand(1, 10)]
];
$sql = "INSERT INTO players (playerid, clubid, firstname, lastname, emailadress, country)
            VALUES (:playerid, :clubid, :firstname, :lastname, :emailadress, :country)";
$result = $pdo->prepare($sql);
foreach ($data as $atribute => $atributeValue){
    $result->bindParam(':'.$atribute, $data[$atribute]);
}
$result->execute();

if ($result)
    echo ('Success');
else
    echo ('ID уже занят');
