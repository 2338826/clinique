<?php
// Importation de l'en-tête
require_once(__DIR__ . "/../partials/header.php");

// Importation des dépendances
require_once(__DIR__ . "/../class/PatientRepository.class.php");
require_once(__DIR__ . "/../class/CliniqueRepository.class.php");

// Définition de l'action par défaut si elle n'est pas définie
$action = $_GET["action"] ?? "afficherListePatient";

// Gestion des actions
switch ($action) {
    case "afficherListePatient":
        $listeClinique = CliniqueRepository::getInstance()->obtenirListeClinique();

        // Sélection de la première clinique par défaut si aucune n'est sélectionnée
        if (!isset($_GET["nomClinique"]) && isset($listeClinique[0])) {
            $_GET["nomClinique"] = $listeClinique[0]->getNom();
        }

        // Récupération de l'ID de la clinique
        $idClinique = CliniqueRepository::getInstance()->obtenirIdClinique($_GET["nomClinique"] ?? "");

        // Récupération des patients de la clinique sélectionnée
        $listePatient = PatientRepository::getInstance()->obtenirListePatient($idClinique);

        require_once(__DIR__ . "/../views/afficherListePatient.php");
        break;
    //switch qui va permettre d'ajouter un patient
    case "ajouterPatient":
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $idClinique = CliniqueRepository::getInstance()->obtenirIdClinique($_POST["nomClinique"] ?? "");

            $nouveauPatient = new PatientDTO(
                $_POST["noDossier"] ?? "",
                $_POST["noAssuranceMaladie"] ?? "",
                $_POST["nom"] ?? "",
                $_POST["prenom"] ?? "",
                $_POST["adresse"] ?? "",
                $_POST["ville"] ?? "",
                $_POST["province"] ?? "",
                $_POST["codePostal"] ?? "",
                $_POST["telephone"] ?? "",
                $_POST["courriel"] ?? ""
            );

            PatientRepository::getInstance()->ajouterPatient($idClinique, $nouveauPatient);


            // Redirection après l'ajout
            header("Location: patientController.php?action=afficherListePatient&nomClinique=" . $_POST['nomClinique']);

            exit();
        }
        break;
    //switch qui va permettre de supprimer un patient
    case "supprimerPatient":
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $nomClinique = $_POST["nomClinique"] ?? "";
            $noDossier = $_POST["noDossier"] ?? "";

            PatientRepository::getInstance()->supprimerPatient($nomClinique, $noDossier);

            header("Location: patientController.php?action=afficherListePatient&nomClinique=" . $_POST['nomClinique']);

            exit();
        }
        break;
    //switch qui va permettre d'afficher le formulaire de la modification d'un patient
    case "formulaireModifierPatient":
        $nomClinique = $_GET["nomClinique"] ?? "";
        $noDossier = $_GET["noDossier"] ?? "";

        $patient = PatientRepository::getInstance()->obtenirPatient($nomClinique, $noDossier);
        require_once(__DIR__ . "/../views/formulaireModifierPatient.php");
        break;
    // switch qui va me permettre de modifier un patient
    case "modifierPatient":
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $patient = new PatientDTO(
                $_POST["noDossier"] ?? "",
                $_POST["noAssuranceMaladie"] ?? "",
                $_POST["nom"] ?? "",
                $_POST["prenom"] ?? "",
                $_POST["adresse"] ?? "",
                $_POST["ville"] ?? "",
                $_POST["province"] ?? "",
                $_POST["codePostal"] ?? "",
                $_POST["telephone"] ?? "",
                $_POST["courriel"] ?? ""
            );

            PatientRepository::getInstance()->modifierPatient($_POST["nomClinique"], $patient);

            header("Location: patientController.php?action=afficherListePatient&nomClinique=" . $_POST['nomClinique']);

            exit();
        }
        break;
}

include(__DIR__ . "/../partials/footer.php");
?>