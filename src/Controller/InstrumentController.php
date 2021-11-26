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

        $positions = array_map(fn($x)=>intval(hexdec($x))%8, str_split(md5('azdjszsdazdazadaoizdoa')));

        return $this->twig->render('Instrument/list.html.twig', ['instruments' => $instruments, 'positions' => $positions]);
    }

    public function results(): string
    {
        $tracks = [];
        $instrumentManager = new InstrumentManager();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $foundIds = array_keys($_POST);
            if (empty($foundIds)) {
                return $this->twig->render('Instrument/results.html.twig');
            }
            $tags = $instrumentManager->selectTagFromInstrument(intval($foundIds[0]));
            $tracks = LastFmApi::tagGetTopTracks($tags[0]['name']);
        }

        return $this->twig->render('Instrument/results.html.twig', ['tracks' => $tracks]);
    }
}
