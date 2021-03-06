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
Route::get('/home', function() {
    return redirect('/');
});
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
Route::get('/song/download/{song}/{type}/{name}', 'SongController@download');
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
Route::post('/register', 'Auth\RegisterController@create')->name('register');
Route::get('/logout', 'Auth\LoginController@logout');
//Route::post('/password/forgot', 'Auth\ForgotPasswordController@sendEmailResetInstructions');
Route::post('/password/send-instructions', 'Auth\ForgotPasswordController@sendEmailResetInstructions')->name('password.instructions');
Route::post('/password/reset', 'Auth\ResetPasswordController@reset')->name('password.reset');
Route::post('/password/update/{user}', 'Auth\ResetPasswordController@resetWithCode')->name('password.update.code');
Route::get('/password-reset-code/{user}', 'Auth\ForgotPasswordController@passwordResetCode')->name('password.reset.code');
Route::post('/comment/', 'CommentController@store');
Route::post('/composer-email/', 'ComposerEmailController@store');
Route::get('/search', 'SearchController@index');
Route::get('/auth/{provider}', 'Auth\SocialAuthController@redirectToProvider');
Route::get('/auth/{provider}/callback', 'Auth\SocialAuthController@handleProviderCallback');

Route::middleware(['auth'])->group(function () {
    Route::group(['middleware' => ['review.songs']], function() {
        Route::get('/upload/song', 'SongUploadController@index')
            ->name('song-upload.index');
    });
    Route::get('/akaunti/review-nyimbo/', 'SongReviewController@index')
        ->name('song-review.index');
    Route::post('/akaunti/review-nyimbo/store', 'SongReviewController@store')
        ->name('song-review.store');
    Route::get('/upload/details', 'SongUploadController@details');
    Route::post('/upload/store', 'SongUploadController@store');
    Route::post('/upload/update', 'SongUploadController@update');
    Route::get('/upload/dominika/{song}', 'SongUploadController@dominika')
            ->name('song-upload.dominika');
    Route::post('/upload/dominika/', 'SongUploadController@storeDominika')
            ->name('song-upload.dominika.store');
    Route::post('/upload/remove-dominika/', 'SongUploadController@deleteDominika')
            ->name('song-upload.dominika.delete');
    Route::get('/upload/preview/{song}', 'SongUploadController@preview')
        ->name('song-upload.preview');
    Route::get('/akaunti', 'AccountController@index')
        ->name('akaunti')
        ->middleware('check_phone');
    Route::get('/akaunti/watunzi', 'ComposerController@account')
            ->name('account.composers');
    Route::get('/akaunti/nyimbo/pending', 'AccountController@pending')
            ->name('account.songs.pending');
    Route::get('/akaunti/nyimbo/live', 'AccountController@live')
            ->name('account.songs.pending');
    Route::get('/mtunzi/create', 'ComposerController@create');
    Route::post('/mtunzi/store', 'ComposerController@store');
    Route::post('/mtunzi/update', 'ComposerController@update');
    Route::get('/mtunzi/edit/{composer}', 'ComposerController@edit');
    Route::get('/edit-song/{song}', 'SongUploadController@edit');
    Route::get('/search/mysongs', 'SearchController@searchUserSongs');
    Route::get('/songs-with-no-categories', 'CleanUpController@missingCategories');
    Route::get('/duplicate-composers', 'CleanUpController@duplicateComposers');
    Route::get('/duplicate-songs', 'CleanUpController@duplicateSongs');
    Route::post('/remove-composer-duplicates', 'CleanUpController@removeDuplicateComposers');
    Route::post('/remove-song-duplicates', 'CleanUpController@removeDuplicateSongs');
    Route::get('/impersonate/{user}', 'AccountController@impersonate');
    Route::get('/stop-impersonation/', 'AccountController@stopImpersonating');
    Route::get('/jobs', 'JobController@index');
    Route::get('/jobs/{job}/delete', 'JobController@delete');
    Route::get('/comments/{comment}', 'CommentController@show');
    Route::post('/phone-collector', 'UserController@savePhoneNumber')->name('save-number');
    Route::get('/phone-collector', 'UserController@getPhoneNumber');
    Route::get('/verify-number', 'UserController@verificationForm')->name('verify-number-form');
    Route::post('/verify-number', 'UserController@verifyNumber')->name('verify-number');
    Route::group(['middleware' => ['role:super admin']], function () {
        Route::get('/admin/dominikas', 'Admin\DominikaController@index')->name('admin-doninika-index');
        Route::get('/admin/dominikas/{dominika}', 'Admin\DominikaController@show')->name('admin-doninika-show');
        Route::post('/admin/dominikas/delete/{dominika}', 'Admin\DominikaController@delete')->name('admin-doninika-delete');
        Route::get('/admin/categories', 'Admin\CategoriesController@index')->name('admin-categories-index');
        Route::post('/admin/categories/save/', 'Admin\CategoriesController@save')->name('admin-categories-save');
        Route::get('/admin/categories/create/', 'Admin\CategoriesController@create')->name('admin-categories-create');
        Route::post('/admin/categories/update/{category}', 'Admin\CategoriesController@update')->name('admin-categories-update');
        Route::get('/admin/categories/{category}', 'Admin\CategoriesController@edit')->name('admin-categories-edit');
        Route::get('/users', 'AdminUserController@index');
        Route::get('/users/search', 'AdminUserController@index');
        Route::get('/admin/users/edit/{user}', 'Admin\UserController@edit');
        Route::post('/admin/users/update/{user}', 'Admin\UserController@update');
        Route::post('/admin/users/change-password-request/{user}', 'Admin\UserController@changePassword');
        Route::get('/prioritize-review/{song}', 'SongReviewController@prioritize');
        Route::get('/deprioritize-review/{song}', 'SongReviewController@deprioritize');
        Route::get('/assign-role/{role}/{user}', 'AdminUserController@assign');
        Route::get('/remove-role/{role}/{user}', 'AdminUserController@remove');
    });
    Route::group(['middleware' => ['permission:kutoa ithibati']], function () {
        Route::get('/akaunti/toa-ithibati', 'IthibatiController@index')
            ->name('song-review.hakiki-ithibati');

        Route::post('/akaunti/toa-ithibati/store', 'IthibatiController@store')
            ->name('song-review.toa-ithibati');
    });
    Route::group(['middleware' => ['role:viongozi uhakiki']], function () {
        Route::get('/prioritize-review/{song}', 'SongReviewController@prioritize');
        Route::get('/deprioritize-review/{song}', 'SongReviewController@deprioritize');
        Route::get('/change-mhakiki/{song}', 'SongReviewController@changeMhakiki');
        Route::post('/save-mhakiki', 'SongReviewController@saveMhakiki');
    });
    Route::group(['middleware' => ['role:viongozi kamati muziki']], function () {
        Route::get('/change-mtoa-ithibati/{song}', 'IthibatiController@changeMtoaIthibati');
        Route::post('/save-mtoa-ithibati', 'IthibatiController@saveMtoaIthibati');
    });
});
Auth::routes();

Route::get('/missing-page', 'HomeController@missingPage')->name('missing-page');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/contact', 'ContactController@index')->name('contact');
Route::post('/contact', 'ContactController@sendEMail')->name('send-message');
