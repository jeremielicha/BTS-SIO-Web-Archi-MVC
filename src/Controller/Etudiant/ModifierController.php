<?php

namespace Quizz\Controller\Etudiant;

use Quizz\Core\View\TwigCore;
use Quizz\Model\EtudiantModel;

class ModifierController implements \Quizz\Core\Controller\ControllerInterface
{
    private int $id;

    public function inputRequest(array $tabInput)
    {
        $etudiantModel=new EtudiantModel();
        if (isset($tabInput["VARS"]["id"])){
            $this->id=$tabInput["VARS"]["id"];
        }
        $this->tabPost=$etudiantModel->verificationForm($tabInput["POST"]);
    }

    public function outputEvent()
    {
        $etudiantModel=new EtudiantModel();
        if (isset($this->tabPost["utilisateur"], $this->tabPost["mdp"] , $this->tabPost["nom"] , $this->tabPost["prenom"] , $this->tabPost["email"])){
            $etudiantModel->modifierEtudiant($this->id,$this->tabPost["utilisateur"],$this->tabPost["mdp"],$this->tabPost["nom"],$this->tabPost["prenom"],$this->tabPost["email"]);
        }
        return TwigCore::getEnvironment()->render("etudiant/modifier.html.twig",[
            'etudiant'=>$etudiantModel->getFetch($this->id)
        ]);
    }
}