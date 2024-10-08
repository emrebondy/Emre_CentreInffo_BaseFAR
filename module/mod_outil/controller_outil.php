<?php
include_once 'modele_outil.php';

class OutilController {
    public function index() {
        $outils = Outil::all(); // Récupérer tous les outils
        include 'vue_outil.php'; // Inclure la vue avec les outils
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = $_POST['nom'];
            if (!empty($nom)) {
                Outil::create($nom);
                echo "Outil ajouté avec succès !";
            } else {
                echo "Le nom de l'outil est obligatoire.";
            }
        }
        $this->index(); // Afficher la liste mise à jour
    }

    public function edit($id) {
        $outil = Outil::find($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = $_POST['nom'];
            if (!empty($nom)) {
                Outil::update($id, $nom);
                echo "Outil mis à jour avec succès !";
                $outil = Outil::find($id); // Récupérer à nouveau l'outil mis à jour
            } else {
                echo "Le nom de l'outil est obligatoire.";
            }
        }
        
        $outils = Outil::all(); // Récupérer tous les outils pour la vue
        include 'vue_outil.php'; // Inclure la vue avec les outils
    }

    public function delete($id) {
        Outil::delete($id);
        echo "Outil supprimé avec succès !";
        $this->index(); // Afficher la liste mise à jour
    }
}
