<?php
// Connexion à la base de données
$conn = new mysqli("localhost", "root", "", "anglaisfacile");

if ($conn->connect_error) {
    die("Échec de la connexion à la base de données: " . $conn->connect_error);
}

// Récupération des données du formulaire
$username = $_POST["username"];
$password = password_hash($_POST["password"], PASSWORD_BCRYPT); // Hachage du mot de passe

// Insérer les données dans la base de données
$sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";

if ($conn->query($sql) === TRUE) {
    // Redirection vers la page de connexion après inscription réussie
    header("Location: connexion.html");
    exit();
} else {
    echo "Erreur lors de l'inscription: " . $conn->error;
}

$conn->close();
?>