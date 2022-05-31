<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Favie;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $favies = \App\Models\User::with('favie')->find(auth()->user())->first();
    return view('dashboard',compact('favies'));
})->middleware(['auth'])->name('dashboard');


Route::get('/movies', function () {
    return view('movie');
});

Route::post('/movies', function (Request $request) {
    $search = $request->input('movie');
    $movies = Http::get('http://www.omdbapi.com/?apikey=45843c2&s='.$search);
    $movies = json_decode($movies);
    return view('movie', compact('movies'));
});

Route::get('/store/{imdbid}', function ($imdbid) {
//dd($imdbid);
$favie = Favie::create([
    'imdbid' => $imdbid,
    'user_id' => auth()->user()->id
]);
return redirect('movies');

})->middleware(['auth']);

require __DIR__.'/auth.php';
