<?php
require_once("Repository.class.php");
require_once("CliniqueDTO.class.php");
class CliniqueRepository extends Repository
{
    private static $_instance;
    private function __construct()
    {
    }

    public static function getInstance(): CliniqueRepository
    {
        if ((!self::$_instance instanceof self))
            self::$_instance = new self();

        return self::$_instance;
    }
    public function obtenirListeClinique()
    {

        try {
            $pdo = new PDO($this->stringConnexion, $this->usager, $this->motDePasse);
            $ins = $pdo->prepare("SELECT * FROM cliniques");
            $ins->setFetchMode(PDO::FETCH_ASSOC);
            $ins->execute();
            $tab = $ins->fetchAll();


            $listeClinique = array();
            for ($i = 0; $i < count($tab); $i++) {
                array_push($listeClinique, new CliniqueDTO($tab[$i]["nom"], $tab[$i]["adresse"], $tab[$i]["ville"], $tab[$i]["province"], $tab[$i]["codePostal"], $tab[$i]["telephone"], $tab[$i]["courriel"]));
            }
        } catch (PDOException $e) {

        }
        return $listeClinique;
    }
    public function obtenirClinique($nomClinique)
    {
        $clinique = null;
        try {
            $pdo = new PDO($this->stringConnexion, $this->usager, $this->motDePasse);
            $ins = $pdo->prepare("SELECT * FROM cliniques WHERE nom =?");
            $ins->setFetchMode(PDO::FETCH_ASSOC);

            $ins->execute(array($nomClinique));
            $tab = $ins->fetch();
            $clinique = new CliniqueDTO(
                $tab["nom"],
                $tab["adresse"],
                $tab["ville"],
                $tab["province"],
                $tab["codePostal"],
                $tab["telephone"],
                $tab["courriel"]
            );

        } catch (PDOException $e) {
            // Gérer l'exception en cas d'erreur de connexion ou d'exécution de la requête
            echo ($e->getMessage());
        }

        return $clinique;


    }
    public function ajouterClinique($cliniqueDTO)
    {
        try {

            $pdo = new PDO($this->stringConnexion, $this->usager, $this->motDePasse);
            $ins = $pdo->prepare("INSERT INTO cliniques (nom, adresse, ville, province, codePostal, telephone, courriel) 
                                  VALUES (?,?,?,?,?,?,?)");
            $ins->setFetchMode(PDO::FETCH_ASSOC);
            $ins->execute(array($cliniqueDTO->getNom(), $cliniqueDTO->getAdresse(), $cliniqueDTO->getVille(), $cliniqueDTO->getProvince(), $cliniqueDTO->getCodePostal(), $cliniqueDTO->getTelephone(), $cliniqueDTO->getCourriel()));

        } catch (PDOException $e) {

        }
        return $cliniqueDTO;

    }
    public function modifierClinique($cliniqueDTO)
    {
        try {
            $pdo = new PDO($this->stringConnexion, $this->usager, $this->password);
            $ins = $pdo->prepare("UPDATE cliniques " .
                "SET adresse=?,ville=?,province=?,codePostal=?,telephone=?,courriel=? " .
                "WHERE nom=?");
            $ins->execute(array($cliniqueDTO->getAdresse(), $cliniqueDTO->getVille(), $cliniqueDTO->getProvince(), $cliniqueDTO->getCodePostal(), $cliniqueDTO->getTelephone(), $cliniqueDTO->getCourriel(), $cliniqueDTO->getNom()));
        } catch (Exception $e) {
        }
    }
    public function supprimerClinique($nomClinique)
    {
        try {
            $pdo = new PDO($this->stringConnexion, $this->usager, $this->password);
            $ins = $pdo->prepare("DELETE FROM cliniques " .
                "WHERE nom=?");
            $ins->execute(array($nomClinique));
        } catch (Exception $e) {
        }
    }

    //Méthode permettant d'obtenir le id d'une clinique par son nom...
    public function obtenirIdClinique($nomClinique)
    {
        $pdo = new PDO($this->stringConnexion, $this->usager, $this->password);
        $ins = $pdo->prepare("SELECT id FROM cliniques " .
            "WHERE nom=?");
        $ins->setFetchMode(PDO::FETCH_ASSOC);
        $ins->execute(array($nomClinique));
        $resultat = $ins->fetch();
        $idPatient = $resultat["id"];
        return $idPatient;
    }
}
?>