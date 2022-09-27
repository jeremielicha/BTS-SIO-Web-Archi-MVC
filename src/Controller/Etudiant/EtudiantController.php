<?php

namespace Quizz\Controller\Etudiant;

use Quizz\Core\View\TwigCore;
use Quizz\Model\EtudiantModel;

class EtudiantController implements \Quizz\Core\Controller\ControllerInterface
{
    private int $id;

    public function inputRequest(array $tabInput)
    {
        if (isset($tabInput["VARS"]["id"])) {
            $this->id = $tabInput["VARS"]["id"];
            }
    }

    public function outputEvent(): string
    {
        $etudiantModel=new EtudiantModel();
        return TwigCore::getEnvironment()->render('etudiant/etudiant.html.twig',[
            'etudiant'=>$etudiantModel->getFetch($this->id)
        ]);
    }
}