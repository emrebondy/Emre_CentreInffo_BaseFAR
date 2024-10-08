<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gérer les Outils</title>
</head>
<body>
    <?php if (isset($outil)): ?>
        <h1>Modifier l'Outil</h1>
        <form method="POST" action="">
            <input type="hidden" name="id" value="<?= $outil['id'] ?>">
            <label for="nom">Nom :</label>
            <input type="text" name="nom" id="nom" value="<?= $outil['nom'] ?>" required>
            <br><br>
            <button type="submit">Mettre à jour</button>
        </form>
        <br>
        <form method="GET" action="">
            <input type="hidden" name="component" value="outils">
            <button type="submit">Retour</button>
        </form>
    <?php else: ?>
        <h1>Ajouter un Outil</h1>
        <form method="POST" action="?component=outils&action=create">
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
        <?php if (isset($outils) && !empty($outils)): ?>
            <?php foreach ($outils as $outil): ?>
                <tr>
                    <td><?= $outil['id'] ?></td>
                    <td><?= $outil['nom'] ?></td>
                    <td>
                        <a href="?component=outils&action=edit&id=<?= $outil['id'] ?>">Modifier</a>
                        <a href="?component=outils&action=delete&id=<?= $outil['id'] ?>">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="3">Aucun outil disponible.</td>
            </tr>
        <?php endif; ?>
    </table>
</body>
</html>
