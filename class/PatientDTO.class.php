<?php
class PatientDTO
{
    //noDossier du patient
    private string $noDossier;
    //noAssurranceMaladie du patient
    private string $noAssuranceMaladie;
    //nom du patient
    private string $nom = "";
    //prenom du patient
    private string $prenom = "";
    //adresse du patient
    private string $adresse = "";
    //ville du patient
    private string $ville = "";
    //province du patient
    private string $province = "";
    //codePostal du patient
    private string $codePostal = "";
    //telephone du patient
    private string $telephone = "";
    //courriel du patient
    private string $courriel = "";

    // le constructeur
    public function __construct($noDossier = "", $noAssuranceMaladie = "", $nom = "", $prenom = "", $adresse = "", $ville = "", $province = "", $codePostal = "", $telephone = "", $courriel = "")
    {
        $this->noDossier = $noDossier;
        $this->noAssuranceMaladie = $noAssuranceMaladie;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->adresse = $adresse;
        $this->ville = $ville;
        $this->province = $province;
        $this->codePostal = $codePostal;
        $this->telephone = $telephone;
        $this->courriel = $courriel;
    }
    // methode qui represente les chaines de caractere de l'objet
    public function __tostring()
    {
        return $this->noDossier . "|" . $this->noAssuranceMaladie . "|" . $this->nom . "|" . $this->prenom . "|" . $this->adresse . "|" . $this->ville . "|" . $this->province . "|" . $this->codePostal . "|" . $this->telephone . "|" . $this->courriel;
    }
    // retourne le noDossier
    public function getNoDossier()
    {
        return $this->noDossier;
    }
    //retourne le noD'assurance maladie
    public function getNoAssuranceMaladie()
    {
        return $this->noAssuranceMaladie;
    }
    // retourne le nom
    public function getNom()
    {
        return $this->nom;
    }
    //retourne le prenom
    public function getPrenom()
    {
        return $this->prenom;
    }
    //retourne l'adresse
    public function getAdresse()
    {
        return $this->adresse;
    }
    // retourne la ville
    public function getVille()
    {
        return $this->ville;
    }
    // retourne la province
    public function getProvince()
    {
        return $this->province;
    }
    // retourne le codePostal
    public function getCodePostal()
    {
        return $this->codePostal;
    }
    //retourne le telephone
    public function getTelephone()
    {
        return $this->telephone;
    }
    // retourne le courriel 
    public function getCourriel()
    {
        return $this->courriel;
    }



}
?>