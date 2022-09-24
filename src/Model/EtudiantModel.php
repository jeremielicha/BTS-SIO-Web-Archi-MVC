<?php

namespace Quizz\Model;

use Quizz\Core\Service\DatabaseService;
use Quizz\Entity\Etudiant;

class EtudiantModel
{
    private $bdd;

    public function __construct()
    {
        $this->bdd = DatabaseService::getConnect();
    }

    /**
     * @return array
     */
    public function getFetchAll(){
        $requete=$this->bdd->prepare("SELECT * FROM etudiants");
        $requete->execute();
        $tabEtudiant=[];
        foreach ($requete->fetchAll() as $value)
        {
            $etudiant=new Etudiant();
            $etudiant->setLogin($value["login"]);
            $etudiant->setMotDePasse($value["motDePasse"]);
            $etudiant->setNom($value["nom"]);
            $etudiant->setPrenom($value["prenom"]);
            $etudiant->setEmail($value["email"]);
            $tabEtudiant[]=$etudiant;
        }
        return $tabEtudiant;
    }

    public function insertEtudiant($utilisateur,$mdp,$nom,$prenom,$email){
        //$cost=['cost'=>12];
        $requete=$this->bdd->prepare('INSERT INTO etudiants(login, nom, prenom, email, motDePasse) VALUES(:login, :nom, :prenom, :email, :motDePasse)');
        $requete->execute(array(
            'login' => $utilisateur,
            'nom' => $nom,
            'prenom' => $prenom,
            'email' => $email,
            'motDePasse' => $mdp
        ));
    }
}