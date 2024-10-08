<?php
include_once 'modele_theme.php';

class ThemeController {
    // Afficher tous les thèmes
    public function index() {
        $themes = Theme::all();
        include 'vue_theme.php';
    }

    // Créer un nouveau thème
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $intitule = $_POST['intitule'];
            $synonymes = $_POST['synonymes'];

            if (!empty($intitule)) {
                Theme::create($intitule, $synonymes);
                echo "Thème ajouté avec succès !";
            } else {
                echo "L'intitulé du thème est obligatoire.";
            }
        }
        $this->index();
    }

    // Modifier un thème
    public function edit($id) {
        $theme = Theme::find($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $intitule = $_POST['intitule'];
            $synonymes = $_POST['synonymes'];

            if (!empty($intitule)) {
                Theme::update($id, $intitule, $synonymes);
                echo "Thème mis à jour avec succès !";
            } else {
                echo "L'intitulé du thème est obligatoire.";
            }
            $theme = Theme::find($id);
        }

        $themes = Theme::all();

        include 'vue_theme.php';
    }

    // Supprimer un thème
    public function delete($id) {
        Theme::delete($id);
        echo "Thème supprimé avec succès !";
        $this->index();
    }
}
?>
