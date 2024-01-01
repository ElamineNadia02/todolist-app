<?php
require './database.php';

$database = new Database('localhost', 'root', 'nadiaelamine2002', 'todolist');

$taches = $database->query("SELECT * FROM todo ORDER BY created_at DESC")->fetchAll();

//Vérifier si toutes les tâches sont marquées comme "done"
$toutesDone = true;
foreach ($taches as $tache) {
    if (!$tache['done']) {
        $toutesDone = false;
        break;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap.min.css">
    <style>
        .custom-list {
            max-width: 500px;
            margin: auto;
        }
        .alert-container{
            margin-left:38em;
            margin-top: 1.5em;
            margin-bottom: 1.5em;
        }
    </style>
    <title>TODOLIST</title>
</head>

<body>
    <header class="row">
        <h1 class="bg-dark text-white px-4 py-3">TodoList</h1>
    </header>
    <div class="container text-center">
        <form method="post" action="addTodo.php" class="d-flex justify-content-center">
            <div class="form-group m-1" style="max-width:300px;">
                <input type="text" class="form-control col" name="title" placeholder="Task Title">
            </div>
            <button type="submit" class="btn btn-primary m-1">Add</button>
        </form>
    </div>
    <div class="alert-container">
        <?php if ($toutesDone) : ?>
            <div class="card bg-info text-white text-center col-4">
                <div class="card-body">
                    Toutes les tâches sont terminées!
                </div>
            </div>
        <?php endif; ?>
    </div>
    <div class="container custom-list">
        <ul class="list-group">
            <?php foreach ($taches as $tache) : ?>
                <li class="list-group-item <?= $tache['done'] ? 'list-group-item-success' : 'list-group-item-warning' ?> border">
                    <div class="d-flex justify-content-between align-items-center">
                        <span><?= $tache['title'] ?></span>
                        <div>
                            <button class="btn btn-done <?= $tache['done'] ? 'btn-primary' : 'btn-primary' ?>" value="toggle" name="action">
                                <a class="text-white text-decoration-none" href="changeStatus.php?id=<?= $tache['id'] ?>&current=<?= $tache['done'] ?>">
                                    <?= $tache['done'] ? 'undo' : 'done' ?>
                                </a>
                            </button>
                            <button class="btn btn-delete btn-danger text-white text-decoration-none" value="delete" name="action">
                                <a class="text-white text-decoration-none" href="/todo/delete.php?id=<?= $tache['id'] ?>">X</a>
                            </button>
                        </div>
                    </div>
                </li>
            <?php endforeach ?>
        </ul>
    </div>
</body>

</html>

