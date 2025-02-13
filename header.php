<?php
// ---------------lance la session php.----------------//

session_start(); // Commencer une session, fonction native

function ConnexionBase()
{ // Infos pour trouver la BDD
    $host = '127.0.0.1';
    $dbname = 'wazaabd';
    $username = 'root';
    $password = '';

    try {
        $connexion = new PDO( // Connexion entre PHP et la BDD
            "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
            $username,
            $password
        );
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Juste pour une erreur 
        return $connexion;
    } catch (Exception $e) { // Attrape l'exception, si ça ne se connecte pas à la BDD
        echo "Erreur : " . $e->getMessage() . "<br>";
        echo "N° : " . $e->getCode();
        die("Fin du script");
    }
}
$db = ConnexionBase(); // Connexion à la base de données

// -----------------------------Créer/Insert - Create de CRUD--------------------------------//

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];

    $sql = "INSERT INTO users (name, email) VALUES (:name, :email)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);

    if ($stmt->execute()) {
        echo "Utilisateur ajouté avec succès!";
    } else {
        echo "Erreur lors de l'ajout de l'utilisateur.";
    }
}

// ---------------------------- lire/select - Read de CRUD--------------------------------//

$sql = "SELECT * FROM users";
$stmt = $pdo->query($sql);  //<----erreur ici //

echo "<table>";
echo "<tr><th>ID</th><th>Nom</th><th>Email</th><th>Actions</th></tr>";

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . $row['name'] . "</td>";
    echo "<td>" . $row['email'] . "</td>";
    echo "<td><a href='edit.php?id=" . $row['id'] . "'>Modifier</a> | <a href='delete.php?id=" . $row['id'] . "'>Supprimer</a></td>";
    echo "</tr>";
}
echo "</table>";

// ---------------------------- Mettre à jour - Update de CRUD--------------------------------//

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM users WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];

    $sql = "UPDATE users SET name = :name, email = :email WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        echo "Utilisateur mis à jour!";
    } else {
        echo "Erreur de mise à jour!";
    }
}
// ---------------------------- Supprimer - Delete de CRUD--------------------------------//

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM users WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        echo "Utilisateur supprimé!";
    } else {
        echo "Erreur lors de la suppression.";
    }
}
?>

<!------------------------------ html ----------------->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!---------------------------------- favicon ----------------------------->
    <link rel="icon" type="image/png" sizes="32x32" href="style/favicon-16x16.png">
    <title></title>
</head>

<header>
    <article id="logo">
        <img src="style/wazaa_logo.png" alt="logoWazaaImmo" width="250" height="250">
    </article>
</header>

<body>
    <main>
            <!--------------------------partie html - Update de CRUD ----------------------->

        <form action="edit.php?id=<?php echo $user['id']; ?>" method="POST">
            <input type="text" name="name" value="<?php echo $user['name']; ?>" required>
            <input type="email" name="email" value="<?php echo $user['email']; ?>" required>
            <button type="submit">Mettre à jour</button>
        </form>

    </main>
</body>

</html>