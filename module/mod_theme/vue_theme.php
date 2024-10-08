<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gérer les Thèmes</title>
</head>
<body>
    <?php if (isset($theme)): ?>
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
        <form method="GET" action="">
            <input type="hidden" name="component" value="outils">
            <button type="submit">Retour</button>
        </form>
    <?php else: ?>
        <h1>Ajouter un Thème</h1>
        <form method="POST" action="?component=themes&action=create">
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
        <?php if (isset($themes) && !empty($themes)): ?>
            <?php foreach ($themes as $theme): ?>
                <tr>
                    <td><?= $theme['id'] ?></td>
                    <td><?= $theme['intitule'] ?></td>
                    <td><?= $theme['synonymes'] ?></td>
                    <td>
                        <a href="?component=themes&action=edit&id=<?= $theme['id'] ?>">Modifier</a>
                        <a href="?component=themes&action=delete&id=<?= $theme['id'] ?>">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="4">Aucun thème disponible.</td>
            </tr>
        <?php endif; ?>
    </table>
</body>
</html>
