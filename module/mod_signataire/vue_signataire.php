<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gérer les Signataire</title>
</head>
<body>
    <?php if (isset($signataire)): ?>
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
        <form method="GET" action="">
            <input type="hidden" name="component" value="signataires">
            <button type="submit">Retour</button>
        </form>
    <?php else: ?>
        <h1>Ajouter un Signataire</h1>
        <form method="POST" action="?component=signataires&action=create">
            <label for="intitule">Intitulé du thème :</label>
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
        <?php if (isset($signataires) && !empty($signataires)): ?>
            <?php foreach ($signataires as $signataire): ?>
                <tr>
                    <td><?= $signataire['id'] ?></td>
                    <td><?= $signataire['intitule'] ?></td>
                    <td><?= $signataire['synonymes'] ?></td>
                    <td>
                        <a href="?component=signataires&action=edit&id=<?= $signataire['id'] ?>">Modifier</a>
                        <a href="?component=signataires&action=delete&id=<?= $signataire['id'] ?>">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="4">Aucun signataire disponible.</td>
            </tr>
        <?php endif; ?>
    </table>
</body>
</html>
