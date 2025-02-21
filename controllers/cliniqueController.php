<?php
//Importation de l'en-tête...
require_once(__DIR__ . "/../partials/header.php");
//Importation des dépendances...
require_once(__DIR__ . "/../class/CliniqueRepository.class.php");

?>
<?php
//Si la variable action ne contient pas de valeur...
if (!isset($_GET["action"]))
	//On l'initialise à l'action pat défault...
	$_GET["action"] = "afficherListeClinique";
//Selon l'action...
switch ($_GET["action"]) {
	//On affiche la liste des cliniques...
	case "afficherListeClinique":
		//Préparation de la liste des cliniques pour la vue...
		$listeClinique = CliniqueRepository::getInstance()->obtenirListeClinique();
		//Importation de la vue...
		require_once(__DIR__ . "/../views/afficherListeClinique.php");
		break;
	//On ajoute la clinique...
	case "ajouterClinique":
		//Appel de l'ajout au repository...

		//Appel de l'ajout au repository...
		CliniqueRepository::getInstance()->ajouterClinique(new CliniqueDTO($_POST["nom"], $_POST["adresse"], $_POST["ville"], $_POST["province"], $_POST["codePostal"], $_POST["telephone"], $_POST["courriel"]));
		//Redirection vers la page cliniqueController.php pour l'affichage.
		header('location:cliniqueController.php');
		//Redirection vers la page cliniqueController.php pour l'affichage.
		break;
	//On supprime la clinique...
	case "supprimerClinique":
		//Appel de la suppression au repository...
		CliniqueRepository::getInstance()->supprimerClinique($_POST["nomClinique"]);
		//Redirection vers la page cliniqueController.php pour l'affichage.
		header('Location: cliniqueController.php');
		break;
	//On ouvre le formulaire de modification de clinique...
	case "formulaireModifierClinique":
		//Préparation de la clinique pour la vue.
		$clinique = CliniqueRepository::getInstance()->obtenirClinique($_GET["nomClinique"]);
		//Importation de la vue...
		require_once(__DIR__ . "/../views/formulaireModifierClinique.php");

		break;
	//On modifie la clinique...
	case "modifierClinique":
		//Appel de la modification au repository...

		CliniqueRepository::getInstance()->modifierClinique(new CliniqueDTO($_POST["nom"], $_POST["adresse"], $_POST["ville"], $_POST["province"], $_POST["codePostal"], $_POST["telephone"], $_POST["courriel"]));
		//Redirection vers la page cliniqueController.php pour l'affichage.

		header('location:cliniqueController.php');
		break;
}
?>
<?php
//Importation du pied de page...
include(__DIR__ . "/../partials/footer.php");
?>