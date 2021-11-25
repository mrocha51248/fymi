<?php

namespace App\Service;

use Symfony\Component\HttpClient\HttpClient;

class LastFmApi
{
    private const HOST_NAME = 'http://ws.audioscrobbler.com';

    public static function getTopTracksFromTag(string $tag): array
    {
        $url =
            self::HOST_NAME . '/2.0/?method=tag.gettoptracks' .
            '&tag=' . $tag .
            '&api_key=' . LASTFM_API_KEY . '&format=json';
        $client = HttpClient::create();
        $response = $client->request('GET', $url);
        $content = $response->toArray();
        return $content['tracks']['track'] ?? [];
    }
}
