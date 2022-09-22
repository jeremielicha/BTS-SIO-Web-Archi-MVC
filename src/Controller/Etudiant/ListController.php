<?php

namespace Quizz\Controller\Etudiant;

use Quizz\Core\Controller\ControllerInterface;
use Quizz\Core\View\TwigCore;
use Quizz\Model\EtudiantModel;

class ListController implements ControllerInterface
{
    public function inputRequest(array $tabInput)
    {
        // TODO: Implement inputRequest() method.
    }

    public function outputEvent()
    {
        $etudiantModel=new EtudiantModel();
        return TwigCore::getEnvironment()->render('etudiant/list.html.twig', [
            'etudiants' => $etudiantModel->getFetchAll()
        ]);
    }
}