<?php

namespace App\Controller;

use App\Service\LastFmApi;

class MusicController extends AbstractController
{
    public function index(?string $remove = null, ?int $id = null)
    {
        session_start();
        $basket = $_SESSION['basket'] ?? [
            'tracks' => [],
            'albums' => [],
            'artists' => [],
        ];
        if (isset($remove)) {
            unset($basket[$remove . 's'][$id]);
        }
        foreach (array_keys($_POST) as $id) {
            $result = $_SESSION['search'][intVal($id)];
            $basket[$result['type'] . 's'][] = $result['data'];
        }
        $_SESSION['basket'] = $basket;
        return $this->twig->render('Music/index.html.twig', [
            'basket' => $basket,
            'basketCount' => array_sum(array_map(fn ($x) => count($x), $basket)),
        ]);
    }

    public function search()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return $this->twig->render('Music/search.html.twig', [
                'results' => [],
            ]);
        }
        session_start();
        $results = $this->parseSearchPost();
        $_SESSION['search'] = $results;
        return $this->twig->render('Music/search.html.twig', [
            'results' => $results,
        ]);
    }

    private function getSearchApiResults()
    {
        $search = trim($_POST['text']);
        return [
            isset($_POST['tracks']) ? LastFmApi::searchTracks($search) : [],
            isset($_POST['albums']) ? LastFmApi::searchAlbums($search) : [],
            isset($_POST['artists']) ? LastFmApi::searchArtists($search) : [],
        ];
    }

    private function parseSearchPost()
    {
        list($tracks, $albums, $artists) = $this->getSearchApiResults();
        $results = [];
        while ($tracks || $albums || $artists) {
            if ($tracks) {
                $results[] = [
                    'type' => 'track',
                    'data' => array_shift($tracks)
                ];
            }
            if ($albums) {
                $results[] = [
                    'type' => 'album',
                    'data' => array_shift($albums)
                ];
            }
            if ($artists) {
                $results[] = [
                    'type' => 'artist',
                    'data' => array_shift($artists)
                ];
            }
        }
        return $results;
    }

    public function results()
    {
        session_start();
        $basket = $_SESSION['basket'] ?? [
            'tracks' => [],
            'albums' => [],
            'artists' => [],
        ];
        //$_SESSION = [];
        $tags = [];
        foreach ($basket['tracks'] as $track) {
            foreach (LastFmApi::trackGetTags($track['artist'], $track['name']) as $tag) {
                $tags[$tag['name']] = ($tags[$tag['name']] ?? 0) + 1;
            }
        }
        foreach ($basket['albums'] as $album) {
            foreach (LastFmApi::albumGetTags($album['artist'], $album['name']) as $tag) {
                $tags[$tag['name']] = ($tags[$tag['name']] ?? 0) + 1;
            }
        }
        foreach ($basket['artists'] as $artist) {
            foreach (LastFmApi::artistGetTags($artist['name']) as $tag) {
                $tags[$tag['name']] = ($tags[$tag['name']] ?? 0) + 1;
            }
        }

        //TODO
        // $instruments = [];
        // foreach ($tags as $tag => $weight) {
        //     foreach ($model->getInstrumentsForTag($tag) as $instrument) {
        //         $id = $instrument['id'];
        //         $instruments[$id] = $instruments[$id] ?? [];
        //         $instruments[$id]['data'] = $instrument;
        //         $instruments[$id]['score'] = ($instruments[$id]['score'] ?? 0) + $weight;
        //     }
        // }
        // $totalScore = array_sum(array_column($instrument, 'score'));
        //render(results.twig, $instruments, $totalScore)
    }
}