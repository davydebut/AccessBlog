<?php
include 'partials/head.php';
require 'connectBdd.php';
include 'partials/nav.php';
$connection = connectionBaseDeDonnee();


if (isset($_POST['inscription'])) {
    $pseudo = $_POST['pseudo'];
    $tamere = $_POST['password'];
    $email = $_POST['email'];
    $password = password_hash($tamere, PASSWORD_BCRYPT);
    $password = substr($password, 0, 60);
    $query = $connection->prepare('INSERT INTO users (pseudo, password, email) VALUES (:pseudo, :password, :email)');
    $query->execute(array(
        'pseudo' => $pseudo,
        'password' => $password,
        'email' => $email
    ));
    // Connecté directement l'utilisateur
    $query = $connection->prepare('SELECT * FROM users WHERE pseudo = :pseudo');
    $query->execute(array(
        'pseudo' => $pseudo
    ));
    $user = $query->fetch(PDO::FETCH_ASSOC);
    $_SESSION['user'] = $user;
    $_SESSION['pseudo'] = $pseudo;
    $_SESSION['id'] = $user['id'];
    header('Location: index.php');
}
?>
<form action="" method="POST"> <!-- action c'est l'endroit à envoyer les données" -->
    <div class="mb-3">
        <label for="exampleInputEmail1">Pseudo</label>
        <input type="text" class="form-control" id="pseudo" name="pseudo" placeholder="pseudo">
    </div>
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email address</label>
        <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input name="password" type="password" class="form-control" id="exampleInputPassword1">
    </div>
    <button type="submit" name="inscription" class="btn btn-primary">S'inscrire</button>
</form>
<?php
include 'partials/footer.php';
