<?php
require './database.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'], $_GET['current'])) {
    $id = $_GET['id'];
    $currentStatus = $_GET['current'];

    $database = new Database('localhost', 'root', 'nadiaelamine2002', 'todolist');

    // Inverser le statut de la tâche (0 pour 1 et vice versa)
    $newStatus = $currentStatus ? 0 : 1;

    $query = "UPDATE todo SET done = ? WHERE id = ?";
    $database->query($query, [$newStatus, $id]);

    // Rediriger vers la page principale après la mise à jour du statut
    header('Location: index.php');
    exit;
}
?>

