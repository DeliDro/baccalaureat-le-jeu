<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="./main.js"></script>
</head>
<body>
    <form method="POST" action="api/rejoindre-partie">
        <label for="id_partie">ID partie</label>
        <input name="id_partie" type="text">
        <input type="submit" value="Rejoindre">
    </form>
    <p><a href="nouvelle-partie">Créer une nouvelle partie</a></p>
</body>
</html>