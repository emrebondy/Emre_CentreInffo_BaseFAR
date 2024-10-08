<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Outils, Thèmes et Signataires</title>
</head>
<body>
    <h1>Régions & Formation</h1>
    <div>
        <form method="GET">
            <button type="submit" name="component" value="outils">Gérer les Outils</button>
            <button type="submit" name="component" value="themes">Gérer les Thèmes</button>
            <button type="submit" name="component" value="signataires">Gérer les Signataires</button>
        </form>
    </div>

    <?php

    if (isset($_GET['component'])) {
        switch ($_GET['component']) {
            case 'outils':
                include 'module/mod_outil/index_outil.php'; // Inclus l'outil
                break;
            case 'themes':
                include 'module/mod_theme/index_theme.php'; // Inclus le thème
                break;
            case 'signataires':
                include 'module/mod_signataire/index_signataire.php'; // Inclus le signataire
                break;
            default:
                echo "<p>Sélectionnez un composant.</p>";
        }
    }
    ?>
</body>
</html>
