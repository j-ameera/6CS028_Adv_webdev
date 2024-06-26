<?php

header('Content-Type: application/json');

if (isset($_GET['keyword']) && isset($_GET['type'])) {
    $keyword = urlencode($_GET['keyword']);
    $type = $_GET['type'];

    $suggestions = [];

    if ($type === 'youtube') {
        $apiKey = 'AIzaSyBNwAiTYbQpWhpLlhSPKlZ4NOvMjWPlEiM';
        $apiUrl = "https://www.googleapis.com/youtube/v3/search?part=snippet&type=video&q=$keyword&key=$apiKey";

        $response = file_get_contents($apiUrl);
        $data = json_decode($response, true);

        if (isset($data['items'])) {
            foreach ($data['items'] as $item) {
                $suggestions[] = [
                    'title' => $item['snippet']['title'],
                    'videoId' => $item['id']['videoId'],
                    'thumbnail' => $item['snippet']['thumbnails']['default']['url']
                ];
            }
        }
    } elseif ($type === 'giphy') {
        $apiKey = 'O7evqnnVOuut7li5Tcf9QPJOhLZLTSZF';
        $apiUrl = "https://api.giphy.com/v1/gifs/search?api_key=$apiKey&q=$keyword&limit=5";

        $response = file_get_contents($apiUrl);
        $data = json_decode($response, true);

        if (isset($data['data'])) {
            foreach ($data['data'] as $item) {
                $suggestions[] = [
                    'title' => $item['title'],
                    'url' => $item['images']['downsized']['url']
                ];
            }
        }
    }

    echo json_encode($suggestions);
    exit();
}

?>
