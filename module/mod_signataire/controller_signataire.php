<?php
include_once 'modele_signataire.php';

class SignataireController {
    // Afficher tous les Signataire
    public function index() {
        $signataires = Signataire::all();
        include 'vue_signataire.php';
    }

    // Créer un nouveau Signataire
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $intitule = $_POST['intitule'];
            $synonymes = $_POST['synonymes'];

            if (!empty($intitule)) {
                Signataire::create($intitule, $synonymes);
                echo "Signataire ajouté avec succès !";
            } else {
                echo "L'intitulé du Signataire est obligatoire.";
            }
        }
        $this->index();
    }

    // Modifier un Signataire
    public function edit($id) {
        $signataire = Signataire::find($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $intitule = $_POST['intitule'];
            $synonymes = $_POST['synonymes'];

            if (!empty($intitule)) {
                Signataire::update($id, $intitule, $synonymes);
                echo "Signataire mis à jour avec succès !";
            } else {
                echo "L'intitulé du thème est obligatoire.";
            }
            $signataire = Signataire::find($id);
        }

        $signataires = Signataire::all();

        include 'vue_signataire.php';
    }

    // Supprimer un Signataire
    public function delete($id) {
        Signataire::delete($id);
        echo "Signataire supprimé avec succès !";
        $this->index();
    }
}
?>
