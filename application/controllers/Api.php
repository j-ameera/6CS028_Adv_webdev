<?php

header('Content-Type: application/json');

if (isset($_GET['keyword']) && isset($_GET['type'])) {
    $keyword = $_GET['keyword'];
    $type = $_GET['type'];

    $suggestions = [];

    if ($type === 'youtube') {
        // Example suggestions
        $suggestions = [
            ['title' => "YouTube Suggestion 1 for $keyword"],
            ['title' => "YouTube Suggestion 2 for $keyword"],
            ['title' => "YouTube Suggestion 3 for $keyword"]
        ];
    } elseif ($type === 'giphy') {
        // Example suggestions
        $suggestions = [
            ['title' => "GIF Suggestion 1 for $keyword"],
            ['title' => "GIF Suggestion 2 for $keyword"],
            ['title' => "GIF Suggestion 3 for $keyword"]
        ];
    }

    echo json_encode($suggestions);
    exit();
}

?>
