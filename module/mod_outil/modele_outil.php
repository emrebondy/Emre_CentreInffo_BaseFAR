<?php
require 'db.php'; // Connexion à la base de données

class Outil {
    public static function all() {
        global $pdo;
        $stmt = $pdo->query('SELECT * FROM outils');
        return $stmt->fetchAll();
    }

    public static function find($id) {
        global $pdo;
        $stmt = $pdo->prepare('SELECT * FROM outils WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public static function create($nom) {
        global $pdo;
        $stmt = $pdo->prepare('INSERT INTO outils (nom) VALUES (?)');
        return $stmt->execute([$nom]);
    }

    public static function update($id, $nom) {
        global $pdo;
        $stmt = $pdo->prepare('UPDATE outils SET nom = ? WHERE id = ?');
        return $stmt->execute([$nom, $id]);
    }

    public static function delete($id) {
        global $pdo;
        $stmt = $pdo->prepare('DELETE FROM outils WHERE id = ?');
        return $stmt->execute([$id]);
    }
}
