<?php
include('header.php');
$db = ConnexionBDD(); // Connexion à la base de données

 // Vérifie si l'utilisateur est connecté
 if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
    $userType = $_SESSION['user_type'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!---------------------------------- favicon ----------------------------->
    <link rel="icon" type="image/png" sizes="32x32" href="style/favicon-16x16.png">

    <title>Wazaa Immo</title>
    
</head>

<body>

</body>

</html>