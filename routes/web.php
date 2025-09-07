<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

route::get('/movie', function () {  
    $movies = [];

    for ($i = 0; $i < 10; $i++) {
        $movies[] = [
            'title' => 'Movie Title ' . ($i + 1),
            'description' => 'This is the description for movie ' . ($i + 1),
            'release_year' => 2000 + $i,
        ];
    }
    // return $movies;

    echo '<h1>Movies List</h1>';
    echo '<ul>';
    foreach ($movies as $movie) {
        echo '<li>';
        echo '<h2>' . $movie['title'] . '</h2>';
        echo '<p>' . $movie['description'] . '</p>';
        echo '<p>Release Year: ' . $movie['release_year'] . '</p>';
        echo '</li>';
    }
    echo '</ul>';
});