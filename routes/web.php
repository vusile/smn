<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index');
Route::get('/blog/{slug}/{blogPost}', 'BlogPostController@show');
Route::get('/blog', 'BlogPostController@index');
Route::get('/song/{slug}/{song}', function($slug, $song){
    return redirect("/wimbo/$slug/$song", 301);
});
Route::get('/wimbo/{slug}/{song}', 'SongController@show')
        ->middleware(\App\Http\Middleware\CheckSongUrl::class);
Route::get('/composer/profile/{slug}/{composer}', function($slug, $composer){
    return redirect("/watunzi/wasifu-mawasiliano/$slug/$composer", 301);
});
Route::get('/watunzi/wasifu-mawasiliano/{slug}/{composer}', 'ComposerController@show');
Route::get('/composer/songs/{slug}/{composer}', function ($slug, $composer) {
    return redirect("/watunzi/nyimbo/$slug/$composer", 301);
});
Route::get('/watunzi/nyimbo/{slug}/{composer}', 'ComposerController@songs');
Route::get('/watunzi/', 'ComposerController@index');
Route::get('/uploaders/', function() {   
    return redirect('/wapakia-nyimbo', 301);
});
Route::get('/wapakia-nyimbo/', 'UserController@index');
Route::get('/uploader/songs/{slug}/{user}', function ($slug, $user){
    return redirect("/wapakia-nyimbo/$slug/$user", 301);
});
Route::get('/wapakia-nyimbo/{slug}/{user}', 'UserController@songs');
Route::get('/song/download/{song}/{type}', 'SongController@download');
Route::get('/categories', function(){
    return redirect('/makundi-nyimbo', 301);
});
Route::get('/makundi-nyimbo', 'CategoryController@index');
Route::get('/makundi-nyimbo/{slug}/{category}', 'CategoryController@show')
        ->middleware(\App\Http\Middleware\CheckCategoryUrl::class);
Route::get('/category/{slug}/{category}', function($slug, $category) {
    return redirect("/makundi-nyimbo/$slug/$category", 301);
});
Route::get('/nyimbozajumapilinasikukuu/', function () {
    return redirect('/dominika-sikukuu', 301);
});
Route::get('/dominika-sikukuu/', 'DominikaController@index');
Route::get('/nyimbozajumapilinasikukuu/ratiba/{slug}/{dominika}', function ($slug, $dominika) {
    return redirect("/dominika-sikukuu/$slug/$dominika", 301);
});
Route::get('/dominika-sikukuu/{slug}/{dominika}', 'DominikaController@show');
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login');
Route::get('/logout', 'Auth\LoginController@logout');
Route::post('/comment/', 'CommentController@store');
Route::post('/composer-email/', 'ComposerEmailController@store');
Route::get('/search', 'SearchController@index');


Route::middleware(['auth'])->group(function () {
    Route::get('/upload/song', 'SongUploadController@index')
        ->name('song-upload.index');
    Route::get('/upload/details', 'SongUploadController@details');
    Route::post('/upload/store', 'SongUploadController@store');
    Route::post('/upload/update', 'SongUploadController@update');
    Route::get('/upload/dominika/{song}', 'SongUploadController@dominika')
            ->name('song-upload.dominika');
    Route::post('/upload/dominika/', 'SongUploadController@storeDominika')
            ->name('song-upload.dominika.store');
    Route::get('/upload/preview/{song}', 'SongUploadController@preview')
            ->name('song-upload.preview');
    Route::get('/akaunti', 'AccountController@index');
    Route::get('/akaunti/watunzi', 'AccountController@index')
            ->name('account.composers');
    Route::get('/akaunti/nyimbo/pending', 'SongController@pending')
            ->name('account.songs.pending');
    Route::get('/akaunti/nyimbo/live', 'SongController@live')
            ->name('account.songs.pending');
    Route::get('/mtunzi/create', 'ComposerController@create');
    Route::post('/mtunzi/store', 'ComposerController@store');
    Route::get('/edit-song/{song}', 'SongUploadController@edit');
    Route::get('/search/mysongs', 'SearchController@searchUserSongs');
    
});