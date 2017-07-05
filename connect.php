<?php

function connect($host, $user, $password, $db){

    $mysqli = new mysqli($host, $user, $password, $db);
    $mysqli->query('SET NAMES UTF8');
    return $mysqli;

}

function query($sql){

    $mysqli = connect('localhost', 'root', '', 'db_worldshop');

    if(!$mysqli){
        return false;
    }

    $result = $mysqli->query($sql);

    if(is_bool($result)){
        return $result;
    }

    $data = [];
    $i = 0;
    while($row = mysqli_fetch_assoc($result)){
        $data[] = $row;
        $i++;
    }

    return $data;

}