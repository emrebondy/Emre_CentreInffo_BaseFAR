<?php
require 'db.php'; // Connexion à la base de données

// Ajouter ou mettre à jour un signataire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $intitule = $_POST['intitule'];
    $synonymes = $_POST['synonymes'];

    if (!empty($intitule)) {
        if (isset($_POST['id']) && !empty($_POST['id'])) {
            // Mise à jour du signataire
            $id = $_POST['id'];
            $stmt = $pdo->prepare('UPDATE signataires SET intitule = ?, synonymes = ? WHERE id = ?');
            $stmt->execute([$intitule, $synonymes, $id]);
            echo "Signataire mis à jour avec succès !";
        } else {
            // Ajout d'un nouveau signataire
            $stmt = $pdo->prepare('INSERT INTO signataires (intitule, synonymes) VALUES (?, ?)');
            $stmt->execute([$intitule, $synonymes]);
            echo "Signataire ajouté avec succès !";
        }
    } else {
        echo "L'intitulé du signataire est obligatoire.";
    }
}

// Supprimer un signataire
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];

    // Vérifier si l'ID est valide avant de tenter la suppression
    if (!empty($id)) {
        $stmt = $pdo->prepare('DELETE FROM signataires WHERE id = ?');
        $stmt->execute([$id]);
        echo "Signataire supprimé avec succès !";
    } else {
        echo "ID de signataire invalide.";
    }
}

// Récupérer un signataire pour la modification
if (isset($_GET['action']) && $_GET['action'] === 'edit' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare('SELECT * FROM signataires WHERE id = ?');
    $stmt->execute([$id]);
    $signataire = $stmt->fetch();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gérer les Signataires</title>
</head>
<body>
    <?php if (isset($_GET['action']) && $_GET['action'] === 'edit' && $signataire): ?>
        <h1>Modifier le Signataire</h1>
        <form method="POST" action="">
            <input type="hidden" name="id" value="<?= $signataire['id'] ?>">
            <label for="intitule">Intitulé :</label>
            <input type="text" name="intitule" id="intitule" value="<?= $signataire['intitule'] ?>" required>
            <br><br>
            <label for="synonymes">Synonymes :</label>
            <input type="text" name="synonymes" id="synonymes" value="<?= $signataire['synonymes'] ?>" required>
            <br><br>
            <button type="submit">Mettre à jour</button>
        </form>
        <br>
        <!-- Bouton pour réinitialiser le formulaire et ajouter un nouveau signataire -->
        <form method="GET" action="">
            <input type="hidden" name="component" value="signataires">
            <button type="submit">Retour</button>
        </form>
    <?php else: ?>
        <h1>Ajouter un Signataire</h1>
        <form method="POST" action="">
            <label for="intitule">Intitulé du signataire :</label>
            <input type="text" name="intitule" id="intitule" required>
            <br><br>
            <label for="synonymes">Synonymes :</label>
            <input type="text" name="synonymes" id="synonymes" required>
            <br><br>
            <button type="submit">Ajouter</button>
        </form>
    <?php endif; ?>

    <h1>Liste des Signataires</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Intitulé</th>
            <th>Synonymes</th>
            <th>Actions</th>
        </tr>
        <?php
        $stmt = $pdo->query('SELECT * FROM signataires');
        while ($signataire = $stmt->fetch()) {
            echo "<tr>
                <td>{$signataire['id']}</td>
                <td>{$signataire['intitule']}</td>
                <td>{$signataire['synonymes']}</td>
                <td>
                    <a href='?component=signataires&action=edit&id={$signataire['id']}'>Modifier</a>
                    <a href='?component=signataires&action=delete&id={$signataire['id']}'>Supprimer</a>
                </td>
            </tr>";
        }
        ?>
    </table>
</body>
</html>
