<?php
require 'db.php'; // Connexion à la base de données

class Signataire {
    // Récupérer tous les Signataire
    public static function all() {
        global $pdo;
        $stmt = $pdo->query('SELECT * FROM signataires');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupérer un Signataire par ID
    public static function find($id) {
        global $pdo;
        $stmt = $pdo->prepare('SELECT * FROM signataires WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Créer un nouveau Signataire
    public static function create($intitule, $synonymes) {
        global $pdo;
        $stmt = $pdo->prepare('INSERT INTO signataires (intitule, synonymes) VALUES (?, ?)');
        return $stmt->execute([$intitule, $synonymes]);
    }

    // Mettre à jour un Signataire existant
    public static function update($id, $intitule, $synonymes) {
        global $pdo;
        $stmt = $pdo->prepare('UPDATE signataires SET intitule = ?, synonymes = ? WHERE id = ?');
        return $stmt->execute([$intitule, $synonymes, $id]);
    }

    // Supprimer un Signataire
    public static function delete($id) {
        global $pdo;
        $stmt = $pdo->prepare('DELETE FROM signataires WHERE id = ?');
        return $stmt->execute([$id]);
    }
}
?>
