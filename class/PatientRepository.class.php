<?php
// Importation des dépendances
require_once(__DIR__ . "/../class/Repository.class.php");
require_once(__DIR__ . "/../class/PatientDTO.class.php");

//classe PatientRepository
class PatientRepository extends Repository
{
    private static ?PatientRepository $_instance = null;

    private function __construct()
    {
    }

    public static function getInstance(): PatientRepository
    {
        if (self::$_instance === null) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    // Obtenir la liste des patients d'une clinique
    public function obtenirListePatient($nomClinique)
    {

        $listePatient = array();

        try {
            $id = CliniqueRepository::getInstance()->obtenirIdClinique($nomClinique);
            $pdo = new PDO($this->stringConnexion, $this->usager, $this->motDePasse);
            $ins = $pdo->prepare("SELECT * FROM patients WHERE idClinique = ?");
            $ins->setFetchMode(PDO::FETCH_ASSOC);
            $ins->execute([$nomClinique]);
            $patients = $ins->fetchAll();

            foreach ($patients as $p) {
                $listePatient[] = new PatientDTO(
                    $p["noDossier"],
                    $p["noAssuranceMaladie"],
                    $p["nom"],
                    $p["prenom"],
                    $p["adresse"],
                    $p["ville"],
                    $p["province"],
                    $p["codePostal"],
                    $p["telephone"],
                    $p["courriel"]
                );
            }
        } catch (Exception $e) {
            echo "Erreur : " . $e->getMessage();
        }
        return $listePatient;
    }

    // Obtenir un patient par son noDossier
    public function obtenirPatient($nomClinique, $noDossier)
    {
        try {
            $id = CliniqueRepository::getInstance()->obtenirIdClinique($nomClinique);
            $pdo = new PDO($this->stringConnexion, $this->usager, $this->motDePasse);
            $ins = $pdo->prepare("SELECT * FROM patients WHERE idClinique = ? AND noDossier = ?");
            $ins->execute([$id, $noDossier]);
            $tab = $ins->fetch(PDO::FETCH_ASSOC);

            if ($tab) {
                return new PatientDTO(
                    $tab["noDossier"],
                    $tab["noAssurranceMaladie"],
                    $tab["nom"],
                    $tab["prenom"],
                    $tab["adresse"],
                    $tab["ville"],
                    $tab["province"],
                    $tab["codePostal"],
                    $tab["telephone"],
                    $tab["courriel"]
                );
            }
        } catch (Exception $e) {

            echo "Erreur : " . $e->getMessage();
        }
        return null;
    }

    // Ajouter un patient
    public function ajouterPatient($nomClinique, $patientDTO)
    {
        try {
            $id = CliniqueRepository::getInstance()->obtenirIdClinique($nomClinique);
            $pdo = new PDO($this->stringConnexion, $this->usager, $this->motDePasse);
            $ins = $pdo->prepare("INSERT INTO patients (noDossier, noAssuranceMaladie, nom, prenom, adresse, ville, province, codePostal, telephone, courriel, idClinique) 
                                   VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $ins->execute([
                $patientDTO->getNoDossier(),
                $patientDTO->getNoAssuranceMaladie(),
                $patientDTO->getNom(),
                $patientDTO->getPrenom(),
                $patientDTO->getAdresse(),
                $patientDTO->getVille(),
                $patientDTO->getProvince(),
                $patientDTO->getCodePostal(),
                $patientDTO->getTelephone(),
                $patientDTO->getCourriel(),
                $nomClinique
            ]);
        } catch (Exception $e) {

            echo "Erreur : " . $e->getMessage();
        }
    }

    // Modifier un patient
    public function modifierPatient($nomClinique, $patientDTO)
    {
        try {
            $id = CliniqueRepository::getInstance()->obtenirIdClinique($nomClinique);
            $pdo = new PDO($this->stringConnexion, $this->usager, $this->motDePasse);
            $ins = $pdo->prepare("UPDATE patients SET noAssuranceMaladie = ?, nom = ?, prenom = ?, adresse = ?, ville = ?, province = ?, codePostal = ?, telephone = ?, courriel = ?
                                   WHERE noDossier = ? AND idClinique = ?");
            $ins->execute([
                $patientDTO->getNoAssuranceMaladie(),
                $patientDTO->getNom(),
                $patientDTO->getPrenom(),
                $patientDTO->getAdresse(),
                $patientDTO->getVille(),
                $patientDTO->getProvince(),
                $patientDTO->getCodePostal(),
                $patientDTO->getTelephone(),
                $patientDTO->getCourriel(),
                $patientDTO->getNoDossier(),
                $id
            ]);
        } catch (Exception $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }

    // Supprimer un patient
    public function supprimerPatient($nomClinique, $noDossier)
    {
        try {
            $id = CliniqueRepository::getInstance()->obtenirIdClinique($nomClinique);
            $pdo = new PDO($this->stringConnexion, $this->usager, $this->motDePasse);
            $ins = $pdo->prepare("DELETE FROM patients WHERE noDossier = ? AND idClinique = ?");
            $ins->execute([$noDossier, $id]);
        } catch (Exception $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }

    // Obtenir l'ID d'un patient
    public function obtenirIdPatient($nomClinique, $noDossier)
    {
        try {
            $id = CliniqueRepository::getInstance()->obtenirIdClinique($nomClinique);
            $pdo = new PDO($this->stringConnexion, $this->usager, $this->motDePasse);
            $ins = $pdo->prepare("SELECT id FROM patients WHERE noDossier = ? AND idClinique = ?");
            $ins->execute([$noDossier, $nomClinique]);
            $result = $ins->fetch(PDO::FETCH_ASSOC);
            return $result ? $result["id"] : null;
        } catch (Exception $e) {
            echo "Erreur : " . $e->getMessage();
        }
        return null;
    }
}
?>