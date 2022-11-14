<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="main.js"></script>
</head>
<body>
    <!-- Mettre en place un système d'affichage des joueurs qui viennent d'intégrer dans l'interface -->
    Interface de jeu <br>
    Id Partie : <?php echo $_SESSION["id_partie"] ?> <br>
    ID joueur : <?php echo $_SESSION["id_joueur"] ?> <br>
    Nom joueur : <?php echo $_SESSION["nom_joueur"] ?> <br>
</body>
</html>