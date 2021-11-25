<?php

namespace App\Controller;

use App\Model\InstrumentManager;

class InstrumentController extends AbstractController
{
    public function index(): string
    {
        $instrumentManager = new InstrumentManager();
        $instruments = $instrumentManager->selectAll('id');

        return $this->twig->render('Instrument/list.html.twig', ['instruments' => $instruments]);
    }
}
