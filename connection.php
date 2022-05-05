<?php
if (isset($_POST['connection'])) {
    // var_dump($_POST);
    $pseudo = $_POST['pseudo']; // je récupère le pseudo
    $password = $_POST['password']; // je récupère le mot de passe
    if (empty($pseudo) || empty($password)) {
        echo 'Veuillez remplir tous les champs';
    } else {
        $query = $connection->query("SELECT * FROM users WHERE pseudo = '$pseudo'"); // je prépare ma requête SQL pour récupérer les données de l'utilisateur
        $user = $query->fetch(PDO::FETCH_ASSOC); // je récupère les données de l'utilisateur dans un tableau associatif ça renvoie soit un tableau associatif soit false
        // var_dump($user);
        $isSuccess = password_verify($password, $user['password']);
        // var_dump($password, $user['password']); ?> <br> <?php
        // var_dump(password_hash($password, PASSWORD_BCRYPT));
        if ($isSuccess) { // je vérifie que le mot de passe correspond à celui de la BDD
            // var_dump($password);
            $_SESSION['user'] = $user; // je stocke les données de l'utilisateur dans une variable de session
            $_SESSION['pseudo'] = $pseudo; // je stocke le pseudo dans une variable de session
            $_SESSION['id'] = $user['id']; // je stocke l'id de l'utilisateur dans une variable de session
            // header('Location: index.php');
        } else {
            echo 'Mauvais mot de passe';
        }
    }
}
?>

<form class="row g-3" action="" method="POST">
    <div class="col-auto">
        <label for="staticEmail2" class="visually-hidden">Pseudo</label>
        <input name="pseudo" type="text" class="form-control-plaintext" id="staticEmail2" placeholder="pseudo">
    </div>
    <div class="col-auto">
        <label for="inputPassword2" class="visually-hidden">Password</label>
        <input name="password" type="password" class="form-control" id="inputPassword2" placeholder="Password">
    </div>
    <div class="col-auto">
        <button name="connection" type="submit" class="btn btn-primary mb-3">connection</button>
        <a class="btn btn-outline-primary mb-3" role="button" aria-disabled="true" href="inscription.php">inscription</a>
    </div>
</form>