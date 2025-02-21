<?php
class Repository
{
    protected $stringConnexion = "mysql:host=localhost;dbname=clinique";
    protected $usager = "root";

    protected $motDePasse = "";

    public function __tostring()
    {
        return $this->stringConnexion . "|" . $this->usager . "|" . $this->motDePasse;
    }
}
?>