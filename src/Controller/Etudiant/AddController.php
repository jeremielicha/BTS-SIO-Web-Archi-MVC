<?php

namespace Quizz\Controller\Etudiant;

use Quizz\Core\Service\DatabaseService;
use Quizz\Core\View\TwigCore;
use Quizz\Model\EtudiantModel;

class AddController implements \Quizz\Core\Controller\ControllerInterface
{
    private $utilisateur;
    private $mdp;
    private $nom;
    private $prenom;
    private $email;

    public function inputRequest(array $tabInput)
    {
        if (isset($tabInput["POST"]["utilisateur"])){
            $this->utilisateur=$tabInput["POST"]["utilisateur"];
        }
        if (isset($tabInput["POST"]["mdp"])){
            $this->mdp=$tabInput["POST"]["mdp"];
        }
        if (isset($tabInput["POST"]["nom"])){
            $this->nom=$tabInput["POST"]["nom"];
        }
        if (isset($tabInput["POST"]["prenom"])){
            $this->prenom=$tabInput["POST"]["prenom"];
        }
        if (isset($tabInput["POST"]["email"])){
            $this->email=$tabInput["POST"]["email"];
        }
    }

    public function outputEvent()
    {
        if (isset($this->utilisateur, $this->mdp , $this->nom , $this->prenom , $this->email)){
            $etudiantModel=new EtudiantModel();
            $etudiantModel->insertEtudiant($this->utilisateur,$this->mdp,$this->nom,$this->prenom,$this->email);
        }

        return TwigCore::getEnvironment()->render("etudiant/add.html.twig");
    }
}