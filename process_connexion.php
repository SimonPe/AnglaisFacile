<?php
session_start();

// Connexion à la base de données
$conn = new mysqli("localhost", "root", "", "anglaisfacile");

if ($conn->connect_error) {
    die("Échec de la connexion à la base de données: " . $conn->connect_error);
}

// Récupération des données du formulaire
$username = $_POST["username"];
$password = $_POST["password"];

// Requête pour obtenir le mot de passe haché associé à l'utilisateur
$sql = "SELECT id, password FROM users WHERE username = '$username'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row["password"])) {
        // Authentification réussie, redirigez l'utilisateur vers sa page d'accueil
        $_SESSION["user_id"] = $row["id"];
        header("Location: home.php");
    } else {
        echo "Mot de passe incorrect.";
    }
} else {
    echo "Nom d'utilisateur introuvable.";
}

$conn->close();
?>
