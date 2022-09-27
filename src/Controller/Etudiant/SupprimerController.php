<?php

namespace Quizz\Controller\Etudiant;

use Quizz\Model\EtudiantModel;

class SupprimerController implements \Quizz\Core\Controller\ControllerInterface
{
    private int $id;

    public function inputRequest(array $tabInput)
    {
        if (isset($tabInput["VARS"]["id"])) {
            $this->id = $tabInput["VARS"]["id"];
        }
    }

    public function outputEvent()
    {
        $modelEtudiant=new EtudiantModel();
        $modelEtudiant->deleteEtudiant($this->id);
        header('Location: /etudiant');
    }
}