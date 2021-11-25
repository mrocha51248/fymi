<?php

namespace App\Controller;

use App\Model\InstrumentManager;
use App\
class InstrumentController extends AbstractController
{
    public function index(): string
    {
        $instrumentManager = new InstrumentManager();
        $instruments = $instrumentManager->selectAll('id');

        return $this->twig->render('Instrument/list.html.twig', ['instruments' => $instruments]);
    }

    public function result(int $id): string
    {

        $instrumentManager = new InstrumentManager();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $foundIds = array_keys($_POST);
        }
        $tags = $instrumentManager->selectTagFromInstrument($id);

        return $this->twig->render('instrument/results.html.twig', ['instruments' => $instruments]);        
    }
}