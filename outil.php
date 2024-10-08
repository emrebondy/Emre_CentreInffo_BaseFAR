<?php
require 'db.php'; // Connexion à la base de données

// Ajouter ou mettre à jour un outil
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];

    if (!empty($nom)) {
        if (isset($_POST['id']) && !empty($_POST['id'])) {
            // Mise à jour de l'outil
            $id = $_POST['id'];
            $stmt = $pdo->prepare('UPDATE outils SET nom = ? WHERE id = ?');
            $stmt->execute([$nom, $id]);
            echo "Outil mis à jour avec succès !";
        } else {
            // Ajout d'un nouvel outil
            $stmt = $pdo->prepare('INSERT INTO outils (nom) VALUES (?)');
            $stmt->execute([$nom]);
            echo "Outil ajouté avec succès !";
        }
    } else {
        echo "Le nom de l'outil est obligatoire.";
    }
}

// Supprimer un outil
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare('DELETE FROM outils WHERE id = ?');
    $stmt->execute([$id]);

    echo "Outil supprimé avec succès !";
}

// Récupérer un outil pour la modification
if (isset($_GET['action']) && $_GET['action'] === 'edit' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare('SELECT * FROM outils WHERE id = ?');
    $stmt->execute([$id]);
    $outil = $stmt->fetch();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gérer les Outils</title>
</head>
<body>
    <?php if (isset($_GET['action']) && $_GET['action'] === 'edit' && $outil): ?>
        <h1>Modifier l'Outil</h1>
        <form method="POST" action="">
            <input type="hidden" name="id" value="<?= $outil['id'] ?>">
            <label for="nom">Nom :</label>
            <input type="text" name="nom" id="nom" value="<?= $outil['nom'] ?>" required>
            <br><br>
            <button type="submit">Mettre à jour</button>
        </form>
        <br>
        <!-- Bouton pour réinitialiser le formulaire et ajouter un nouvel outil -->
        <form method="GET" action="">
            <button type="submit">Ajouter un nouvel outil</button>
        </form>
    <?php else: ?>
        <h1>Ajouter un Outil</h1>
        <form method="POST" action="">
            <label for="nom">Nom de l'outil :</label>
            <input type="text" name="nom" id="nom" required>
            <br><br>
            <button type="submit">Ajouter</button>
        </form>
    <?php endif; ?>

    <h1>Liste des Outils</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Actions</th>
        </tr>
        <?php
        $stmt = $pdo->query('SELECT * FROM outils');
        while ($outil = $stmt->fetch()) {
            echo "<tr>
                <td>{$outil['id']}</td>
                <td>{$outil['nom']}</td>
                <td>
                    <a href='?action=edit&id={$outil['id']}'>Modifier</a>
                    <a href='?action=delete&id={$outil['id']}'>Supprimer</a>
                </td>
            </tr>";
        }
        ?>
    </table>
</body>
</html>
