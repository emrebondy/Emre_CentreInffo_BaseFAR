<?php
require 'db.php'; // Connexion à la base de données

class Theme {
    // Récupérer tous les thèmes
    public static function all() {
        global $pdo;
        $stmt = $pdo->query('SELECT * FROM themes');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupérer un thème par ID
    public static function find($id) {
        global $pdo;
        $stmt = $pdo->prepare('SELECT * FROM themes WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Créer un nouveau thème
    public static function create($intitule, $synonymes) {
        global $pdo;
        $stmt = $pdo->prepare('INSERT INTO themes (intitule, synonymes) VALUES (?, ?)');
        return $stmt->execute([$intitule, $synonymes]);
    }

    // Mettre à jour un thème existant
    public static function update($id, $intitule, $synonymes) {
        global $pdo;
        $stmt = $pdo->prepare('UPDATE themes SET intitule = ?, synonymes = ? WHERE id = ?');
        return $stmt->execute([$intitule, $synonymes, $id]);
    }

    // Supprimer un thème
    public static function delete($id) {
        global $pdo;
        $stmt = $pdo->prepare('DELETE FROM themes WHERE id = ?');
        return $stmt->execute([$id]);
    }
}
?>
