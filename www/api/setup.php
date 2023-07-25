<?php
// Remplacez ces informations par les détails de votre base de données
$host = 'localhost';
$dbname = 'nom_de_la_base_de_donnees';
$username = 'nom_d_utilisateur';
$password = 'mot_de_passe';

try {
    $dbh = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Configurer PDO pour qu'il génère des exceptions en cas d'erreur
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Erreur de connexion à la base de données : ' . $e->getMessage();
    die();
}



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $databaseName = $_POST['databaseName'];
    $databaseUsername = $_POST['databaseUsername'];
    $databasePassword = $_POST['databasePassword'];

    // Créer une table dans la base de données (exemple très simple)
    $query = "CREATE TABLE esgi_user (
                id INT PRIMARY KEY AUTO_INCREMENT,
                username VARCHAR(255) NOT NULL,
                password VARCHAR(255) NOT NULL
              )";

    try {
        // Exécuter la requête SQL
        $dbh->exec($query);
        echo 'Table créée avec succès !';
    } catch (PDOException $e) {
        echo 'Erreur lors de la création de la table : ' . $e->getMessage();
    }
}
?>
