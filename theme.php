<?php
require 'db.php'; // Connexion à la base de données

// Ajouter ou mettre à jour un thème
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $intitule = $_POST['intitule'];
    $synonymes = $_POST['synonymes'];

    if (!empty($intitule)) {
        if (isset($_POST['id']) && !empty($_POST['id'])) {
            // Mise à jour du thème
            $id = $_POST['id'];
            $stmt = $pdo->prepare('UPDATE themes SET intitule = ?, synonymes = ? WHERE id = ?');
            $stmt->execute([$intitule, $synonymes, $id]);
            echo "Thème mis à jour avec succès !";
        } else {
            // Ajout d'un nouveau thème
            $stmt = $pdo->prepare('INSERT INTO themes (intitule, synonymes) VALUES (?, ?)');
            $stmt->execute([$intitule, $synonymes]);
            echo "Thème ajouté avec succès !";
        }
    } else {
        echo "L'intitulé du thème est obligatoire.";
    }
}

// Supprimer un thème
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];

    // Vérifier si l'ID est valide avant de tenter la suppression
    if (!empty($id)) {
        $stmt = $pdo->prepare('DELETE FROM themes WHERE id = ?');
        $stmt->execute([$id]);
        echo "Thème supprimé avec succès !";
    } else {
        echo "ID de thème invalide.";
    }
}

// Récupérer un thème pour la modification
if (isset($_GET['action']) && $_GET['action'] === 'edit' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare('SELECT * FROM themes WHERE id = ?');
    $stmt->execute([$id]);
    $theme = $stmt->fetch();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gérer les Thèmes</title>
</head>
<body>
    <?php if (isset($_GET['action']) && $_GET['action'] === 'edit' && $theme): ?>
        <h1>Modifier le Thème</h1>
        <form method="POST" action="">
            <input type="hidden" name="id" value="<?= $theme['id'] ?>">
            <label for="intitule">Intitulé :</label>
            <input type="text" name="intitule" id="intitule" value="<?= $theme['intitule'] ?>" required>
            <br><br>
            <label for="synonymes">Synonymes :</label>
            <input type="text" name="synonymes" id="synonymes" value="<?= $theme['synonymes'] ?>" required>
            <br><br>
            <button type="submit">Mettre à jour</button>
        </form>
        <br>
        <!-- Bouton pour réinitialiser le formulaire et ajouter un nouveau thème -->
        <form method="GET" action="">
            <input type="hidden" name="component" value="themes">
            <button type="submit">Retour</button>
        </form>
    <?php else: ?>
        <h1>Ajouter un Thème</h1>
        <form method="POST" action="">
            <label for="intitule">Intitulé du thème :</label>
            <input type="text" name="intitule" id="intitule" required>
            <br><br>
            <label for="synonymes">Synonymes :</label>
            <input type="text" name="synonymes" id="synonymes" required>
            <br><br>
            <button type="submit">Ajouter</button>
        </form>
    <?php endif; ?>

    <h1>Liste des Thèmes</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Intitulé</th>
            <th>Synonymes</th>
            <th>Actions</th>
        </tr>
        <?php
        $stmt = $pdo->query('SELECT * FROM themes');
        while ($theme = $stmt->fetch()) {
            echo "<tr>
                <td>{$theme['id']}</td>
                <td>{$theme['intitule']}</td>
                <td>{$theme['synonymes']}</td>
                <td>
                    <a href='?component=themes&action=edit&id={$theme['id']}'>Modifier</a>
                    <a href='?component=themes&action=delete&id={$theme['id']}'>Supprimer</a>
                </td>
            </tr>";
        }
        ?>
    </table>
</body>
</html>
