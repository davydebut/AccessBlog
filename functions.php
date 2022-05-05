<?php
require 'connectBdd.php';
session_start();
$connection = connectionBaseDeDonnee();
$utilisateurs = $connection->query('SELECT * FROM users');
