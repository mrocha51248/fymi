<?php

namespace App\Service;

use Symfony\Component\HttpClient\HttpClient;

class LastFmApi
{
    private const HOST_NAME = 'http://ws.audioscrobbler.com';

    public static function tagGetTopTracks(string $name): array
    {
        $url =
            self::HOST_NAME . '/2.0/?method=tag.gettoptracks' .
            '&tag=' . urlencode($name) .
            '&api_key=' . LASTFM_API_KEY . '&format=json';
        $client = HttpClient::create();
        $response = $client->request('GET', $url);
        $content = $response->toArray();
        return $content['tracks']['track'] ?? [];
    }

    public static function searchTracks(string $name): array
    {
        $url =
            self::HOST_NAME . '/2.0/?method=track.search' .
            '&track=' . urlencode($name) .
            '&api_key=' . LASTFM_API_KEY . '&format=json';
        $client = HttpClient::create();
        $response = $client->request('GET', $url);
        $content = $response->toArray();
        return $content['results']['trackmatches']['track'] ?? [];
    }

    public static function searchAlbums(string $name): array
    {
        $url =
            self::HOST_NAME . '/2.0/?method=album.search' .
            '&album=' . urlencode($name) .
            '&api_key=' . LASTFM_API_KEY . '&format=json';
        $client = HttpClient::create();
        $response = $client->request('GET', $url);
        $content = $response->toArray();
        return $content['results']['albummatches']['album'] ?? [];
    }

    public static function searchArtists(string $name): array
    {
        $url =
            self::HOST_NAME . '/2.0/?method=artist.search' .
            '&artist=' . urlencode($name) .
            '&api_key=' . LASTFM_API_KEY . '&format=json';
        $client = HttpClient::create();
        $response = $client->request('GET', $url);
        $content = $response->toArray();
        return $content['results']['artistmatches']['artist'] ?? [];
    }

    public static function trackGetTags(string $artist, string $track): array
    {
        $url =
            self::HOST_NAME . '/2.0/?method=track.getTopTags' .
            '&artist=' . urlencode($artist) .
            '&track=' . urlencode($track) .
            '&api_key=' . LASTFM_API_KEY . '&format=json';
        $client = HttpClient::create();
        $response = $client->request('GET', $url);
        $content = $response->toArray();
        return $content['toptags']['tag'] ?? [];
    }

    public static function albumGetTags(string $artist, string $album): array
    {
        $url =
            self::HOST_NAME . '/2.0/?method=album.getTopTags' .
            '&artist=' . urlencode($artist) .
            '&album=' . urlencode($album) .
            '&api_key=' . LASTFM_API_KEY . '&format=json';
        $client = HttpClient::create();
        $response = $client->request('GET', $url);
        $content = $response->toArray();
        return $content['toptags']['tag'] ?? [];
    }

    public static function artistGetTags(string $artist): array
    {
        $url =
            self::HOST_NAME . '/2.0/?method=artist.getTopTags' .
            '&artist=' . urlencode($artist) .
            '&api_key=' . LASTFM_API_KEY . '&format=json';
        $client = HttpClient::create();
        $response = $client->request('GET', $url);
        $content = $response->toArray();
        return $content['toptags']['tag'] ?? [];
    }
}
