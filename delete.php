<?php

require './database.php';

$database = new Database('localhost', 'root', 'nadiaelamine2002', 'todolist');

if (!isset($_GET['id']) || empty($_GET['id']))
{
    header("location: /todo/index.php");
    die;
}


$database->query("delete from todo where id=:id", [
    'id' => $_GET['id']
]);

header("location: /todo/index.php");
