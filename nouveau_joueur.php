<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post" action="api/creer-joueur">
        <label for="nom_joueur">Nom du joueur</label>
        <input type="text" name="nom_joueur">
        <input type="submit" value="S'enregistrer">
    </form>
</body>
</html>