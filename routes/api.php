<?php

use Illuminate\Http\Request;
use App\Http\Resources\Collections\SongCollection;
use App\Models\Song;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/wimbo/{song}', 'Api\SongController@show');
Route::get('/nyimbo-nyingine/{song}', 'Api\SongController@otherSongs');
Route::get('/watunzi/', 'Api\ComposerController@index');
Route::get('/watunzi/{composer}', 'Api\ComposerController@show');
Route::get('/watunzi/nyimbo/{composer}', 'Api\ComposerController@songs');
Route::get('/makundi-nyimbo', 'Api\CategoryController@index');
Route::get('/makundi-nyimbo/{category}', 'Api\CategoryController@show');
Route::get('/dominika-sikukuu/', 'Api\DominikaController@index');
Route::get('/dominika-sikukuu/zifuatazo', 'Api\DominikaController@thisWeek');
Route::get('/dominika-sikukuu/{dominika}', 'Api\DominikaController@show');
Route::get('/search', 'Api\SearchController@index');