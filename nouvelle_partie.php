<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post" action="api/nouvelle-partie">
        <div>
            <label for="nom_partie">Nom de la partie</label>
            <input type="text" name="nom_partie">
        </div>

        <div>
            <label for="description">Description</label>
            <input type="text" name="description">
        </div>
        
        <div>
            <label for="nb_tours">Nombre de tours</label>
            <select name="nb_tours" id="">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="15">15</option>
                <option value="20">20</option>
            </select>
        </div>

        <div>
            <label for="remise_lettre">Remise des lettres</label>
            <input type="checkbox" name="remise_lettre">
        </div>
        
        <input type="submit" value="Lancer">
    </form>
</body>
</html>