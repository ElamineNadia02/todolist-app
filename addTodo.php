<?php
require './database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';

    if (!empty($title)) {
        $database = new Database('localhost', 'root', 'nadiaelamine2002', 'todolist');

        // Par défaut, la nouvelle tâche est "non réalisée" (done = 0)
        $query = "INSERT INTO todo (title, done) VALUES (?, 0)";
        $database->query($query, [$title]);

        // Rediriger vers la page principale après l'ajout de la tâche
        header('Location: index.php');
        exit;
    }
}
?>

