<?php

namespace App\Controller;

use App\Model\InstrumentManager;
use App\Service\LastFmApi;

class InstrumentController extends AbstractController
{
    public function index(): string
    {
        $instrumentManager = new InstrumentManager();
        $instruments = $instrumentManager->selectAll('id');

        return $this->twig->render('Instrument/list.html.twig', ['instruments' => $instruments]);
    }

    public function results(): string
    {
        $tracks = LastFmApi::tagGetTopTracks("rock");

        return $this->twig->render('Instrument/results.html.twig', ['tracks' => $tracks]);
    }
}
