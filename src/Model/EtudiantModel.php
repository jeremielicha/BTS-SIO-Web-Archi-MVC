<?php

namespace Quizz\Model;

use Quizz\Core\Service\DatabaseService;
use Quizz\Entity\Etudiant;

class EtudiantModel
{
    private \PDO $bdd;

    public function __construct()
    {
        $this->bdd = DatabaseService::getConnect();
    }

    /**
     * @return array
     */
    public function getFetchAll(): array
    {
        $requete=$this->bdd->prepare("SELECT * FROM etudiants");
        $requete->execute();
        $tabEtudiant=[];
        foreach ($requete->fetchAll() as $e)
        {
            $etudiant = $this->getEtudiant($e);
            $tabEtudiant[]=$etudiant;
        }
        return $tabEtudiant;
    }

    /**
     * @param $utilisateur
     * @param $mdp
     * @param $nom
     * @param $prenom
     * @param $email
     * @return void
     */
    public function addEtudiant($utilisateur,$mdp,$nom,$prenom,$email): void
    {
        $requete=$this->bdd->prepare("INSERT INTO etudiants(login, motDePasse, nom, prenom, email) 
        VALUES('$utilisateur','$mdp','$nom','$prenom','$email')");
        $requete->execute();
    }

    public function deleteEtudiant($id): void
    {
        $requete=$this->bdd->prepare("DELETE FROM etudiants WHERE idEtudiant={$id}");
        $requete->execute();
    }

    public function modifierEtudiant($idEtudiant,$utilisateur,$mdp,$nom,$prenom,$email): void
    {
        $requete=$this->bdd->prepare("
        UPDATE etudiants
        SET login='$utilisateur',
            motDePasse='$mdp',
            nom='$nom',
            prenom='$prenom',
            email='$email'
        WHERE idEtudiant='$idEtudiant'");
        $requete->execute();
    }

    public function getFetch($id): Etudiant
    {
        $requete=$this->bdd->prepare("SELECT * FROM etudiants WHERE idEtudiant={$id}");
        $requete->execute();
        $result=$requete->fetch();
        return $this->getEtudiant($result);
    }

    /**
     * @param array $result
     * @return Etudiant
     */
    public function getEtudiant(array $result): Etudiant
    {
        $etudiant = new Etudiant();
        $etudiant->setIdEtudiant($result["idEtudiant"]);
        $etudiant->setLogin($result["login"]);
        $etudiant->setMotDePasse($result["motDePasse"]);
        $etudiant->setNom($result["nom"]);
        $etudiant->setPrenom($result["prenom"]);
        $etudiant->setEmail($result["email"]);
        return $etudiant;
    }

    public function verificationForm($tabPost){
        foreach ($tabPost as $keyName=>$name){
            if (isset($keyName)){
                $tabPost[$keyName]=$name;
            }
        }
        return $tabPost;
    }
}