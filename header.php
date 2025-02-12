<?php
session_start();

// ---------------lance la session php.----------------//

function ConnexionBDD()

//---------------info bdd------------------------------//

{
    $host = 'localhost';
    $dbname = 'wazaabd';
    $username = '';
    $password = '';

    try {
        $connexion = new PDO(
            "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
            $username,
            $password
        );

        // ------------------- si il y a une erreur cela afifchera une page erreur ---------------------//

        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $connexion;
    } catch (Exception $e) { // Attrape l'exception, si ça ne se connecte pas à la BDD
        echo "Erreur : " . $e->getMessage() . "<br>";
        echo "N° : " . $e->getCode();
        die("Fin du script");
    }
}
$db = ConnexionBDD(); // Connexion à la base de données

// Vérifie si l'utilisateur est connecté
$username = null;
if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
    $userTypeS = $_SESSION['user_type'];

    // Récupération des informations de l'utilisateur
    $stmtUser = $db->prepare("SELECT * FROM users WHERE id_user = :userId"); // Variable qui contient la préparation de la requête SQL
    $stmtUser->execute(['userId' => $userId]);
    $user = $stmtUser->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $username = $user['firstname_user'];
    }
} else {
    $db = ConnexionBDD(); // Connexion à la base de données
    // Défini le rôle d'utilisateur comme "Invité" si l'utilisateur n'est pas connecté
    $_SESSION['user_type'] = 'Invite';
    $_SESSION['user_id'] = null;
}

// Vérifie si l'utilisateur est admin
$isAdmin = isset($_SESSION['user_type']) && in_array($_SESSION['user_type'], ['Admin']);

?>
<!---------------------------------- html ----------------------------->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!---------------------------------- favicon ----------------------------->
    <link rel="icon" type="image/png" sizes="32x32" href="style/favicon-16x16.png">
    <title></title>
</head>

<body>

    <header>

    </header>

    <main>

    </main>

    <footer>

    </footer>
    
</body>

</html>