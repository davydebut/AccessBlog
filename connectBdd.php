<?php
// connect to the database pdo
function connectionBaseDeDonnee() {
    try {
        $bdd = new PDO('mysql:host=localhost;dbname=accessblog;charset=utf8', 'root', '');
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $bdd;
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

