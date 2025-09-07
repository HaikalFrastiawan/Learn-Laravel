<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

$movies = [];

for ($i = 0; $i < 10; $i++) {
    $movies[] = [
        'title' => 'Movie ' . $i,
        'year'  => '2022',
        'genre' => 'Action',
    ];
}

Route::group([
    'prefix' => 'movie',
    'as' => 'movie.',
], function () use ($movies) {

    // ✅ login bebas diakses
    Route::get('/login', function () {
        return 'Login page';
    })->name('login');

    // ✅ route di bawah ini wajib lewat middleware isAuth
    Route::middleware('isAuth')->group(function () use ($movies) {

        // GET /movie
        Route::get('/', function () use ($movies) {
            return $movies;
        });

        // GET /movie/{id}
        Route::get('/{id}', function ($id) use ($movies) {
            return $movies[$id] ?? 'Movie not found';
        })->middleware('isMember');

        // POST /movie
        Route::post('/', function () use ($movies) {
            $movies[] = [
                'title' => request('title'),
                'year'  => request('year'),
                'genre' => request('genre'),
            ];
            return $movies;
        });

        // PUT /movie/{id}
        Route::put('/{id}', function ($id) use ($movies) {
            $movies[$id]['title'] = request('title');
            $movies[$id]['year']  = request('year');
            $movies[$id]['genre'] = request('genre');

            return $movies;
        });

        // DELETE /movie/{id}
        Route::delete('/{id}', function ($id) use ($movies) {
            unset($movies[$id]);
            return $movies;
        });

        // GET /movie/pricing
        Route::get('/pricing', function () {
            return 'please buy a membership';
        });
    });
});
