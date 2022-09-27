<?php

namespace Quizz\Controller\Etudiant;

use Quizz\Core\DebugHandler;
use Quizz\Core\View\TwigCore;
use Quizz\Model\EtudiantModel;

class AddController implements \Quizz\Core\Controller\ControllerInterface
{
    private array $tabPost;

    public function inputRequest(array $tabInput)
    {
        $etudiantModel=new EtudiantModel();
        $this->tabPost=$etudiantModel->verificationForm($tabInput["POST"]);
    }

    public function outputEvent()
    {
        $alert=false;
        if (isset($this->tabPost["utilisateur"], $this->tabPost["mdp"] , $this->tabPost["nom"] , $this->tabPost["prenom"] , $this->tabPost["email"])){
            $etudiantModel=new EtudiantModel();
            $etudiantModel->addEtudiant($this->tabPost["utilisateur"],password_hash($this->tabPost["mdp"],PASSWORD_DEFAULT),$this->tabPost["nom"],$this->tabPost["prenom"],$this->tabPost["email"]);
            $alert=true;
        }

        echo TwigCore::getEnvironment()->render("etudiant/add.html.twig",[
            'alert'=>$alert
        ]);
    }
}