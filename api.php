<?php
session_start();

/**
 * COMPOSITION D'UNE PARTIE
 *      - Joueur (id_joueur, nom_joueur, id_partie, total)
 *      - Ligne (id_ligne, id_joueur, lettre, fille, garçon, ville, pays, animal, fruit, métier, s_fille, s_garçon, s_ville, s_pays, s_animal, s_fruit, s_métier)
 *      - Partie (id_partie, nom_partie, description, nb_tours, remise_lettre, date_création)
 */

switch ($_SERVER["REQUEST_URI"]) {        
    case '/api/creer-joueur':
        creer_joueur();
        break;

    case '/api/creer-ligne':
        # code...
        break;

    case '/api/rejoindre-partie':
        rejoindre_partie();
        break;
    
    case '/api/nouvelle-partie':
        creer_partie();
        break;
    
    case '/api/update_state':
        update_state();
        break;
}

/**
 * Processus de création de partie
 *      01. Renseigner informations d'une partie
 *      02. Créer la partie en base de données
 *      03. Créer un joueur
 *      04. Afficher l'interface de la partie
 */
function creer_partie() {
    if (isset($_POST["nom_partie"])) {
        # On "caste" la checkbox du choix de remise
        $_POST["remise_lettre"] = isset($_POST["remise_lettre"]) ? TRUE : FALSE;
        
        $result = db_handler("creer_partie", array_values($_POST));
        
        if ($result !== null) {
            $last_id_partie = intval(db_handler("last_id_partie")[0]->last_id);
            $_SESSION["id_partie"] = $last_id_partie;
            header("Location: /nouveau-joueur");
        }
    }
    else {
        echo "Erreur d'enregistrement";
    }
}

/**
 * Processus d'intégration à une partie
 *      01. Entrer l'ID de la partie
 *      02. Le backend vérifie l'existence de la partie en cours
 *      03. Si oui
 *          03.01. L'ID de la partie est une variable de session
 *          03.02. L'interface de choix de nom est affichée
 *          03.03. Après la saisie du nom, Un joueur est créé
 *          03.04. L'interface de jeu est affichée
 *      04. Sinon, on signifie que la partie n'est pas reconnue
 */
function rejoindre_partie() {
    if (isset($_POST["id_partie"])) {        
        $result = db_handler("lire_partie", array_values($_POST));
        
        if ($result !== null) {
            if (count($result)) {
                $_SESSION["id_partie"] = $_POST["id_partie"];
                header("Location: /nouveau-joueur");
            }
            else {
                echo "Partie inexistante";
            }
        }
    }
    else {
        echo "ID non renseigné";
    }
}

function creer_joueur() {
    if (isset($_POST["nom_joueur"])) {
        db_handler("creer_joueur", [$_POST["nom_joueur"], $_SESSION["id_partie"]]);
        
        $last_id_joueur = intval(db_handler("last_id_joueur")[0]->last_id);
        
        $_SESSION["id_joueur"] = $last_id_joueur;
        $_SESSION["nom_joueur"] = $_POST["nom_joueur"];
        
        header("Location: /interface");
    }
    else {
        echo "Erreur d'enregistrement";
    }
}

function update_state() {
    echo "UPDATE_STATE";
}

function db_handler($request, $data = []) {
    $date = date('Y-m-d H:i:s');
    
    $queries = array(
        "creer_partie" => "INSERT INTO Partie (nom_partie, description, nb_tours, remise_lettre, date_creation) VALUES (?, ?, ?, ?, '$date')",
        "creer_joueur" => "INSERT INTO Joueur (nom_joueur, id_partie, total) VALUES (?, ?, 0)",
        "creer_ligne" => "INSERT INTO Ligne VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)",
        "lire_partie" => "SELECT * FROM Partie WHERE id_partie = ?",
        "lire_joueur" => "SELECT * FROM Joueur WHERE id_joueur = ?",
        "lire_ligne" => "SELECT * FROM Ligne WHERE id_ligne = ?",
        "lire_lignes_joueur" => "SELECT * FROM Ligne WHERE id_joueur = ?",
        "lire_last_ligne_joueur" => "SELECT * FROM Ligne WHERE id_joueur = ? AND id_ligne = MAX(id_ligne)",
        "calculer_total_joueur" => "SELECT SUM(s_fille + s_garcon + s_ville + s_pays + s_animal + s_fruit + s_metier) total FROM Ligne WHERE id_joueur = ?",
        "modifier_total" => "UPDATE Joueur SET total = (SELECT SUM(s_fille + s_garcon + s_ville + s_pays + s_animal + s_fruit + s_metier) FROM Ligne WHERE id_joueur = ?) WHERE id_joueur = ?",
        "last_id_partie" => "SELECT MAX(id_partie) last_id FROM Partie",
        "last_id_joueur" => "SELECT MAX(id_joueur) last_id FROM Joueur",
    );
    
    try {
        $PDO = new PDO('mysql:host=localhost;dbname=bac','root','');
        $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $PDO->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

        $PDOStatement = $PDO->prepare($queries[$request]);
        $PDOStatement->execute($data);
        
        return $PDOStatement->fetchAll();
    } catch(PDOException $e){
        echo 'Erreur lors de la lecture\n';
        echo var_dump($e);
    }
    
    return null;
}
?>