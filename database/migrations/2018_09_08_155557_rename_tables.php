<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('piano_categories', 'categories');
        Schema::rename('piano_composers', 'composers');
        Schema::rename('piano_backend_users', 'users');
        Schema::rename('piano_contributions_account', 'contributions');
        Schema::rename('piano_emails', 'emails');
        Schema::rename('piano_not_reviewed_reasons', 'not_reviewed_reasons');
        Schema::rename('piano_old_status', 'old_status');
        Schema::rename('piano_pages', 'pages');
        Schema::rename('piano_songs_categories', 'song_categories');
        Schema::rename('piano_song_downloads', 'song_downloads');
        Schema::rename('daily_downloads', 'daily_song_downloads');
        Schema::rename('daily_views', 'daily_song_views');
        Schema::rename('piano_song_statuses', 'song_statuses');
        Schema::rename('piano_song_views', 'song_views');
        Schema::rename('piano_transaction_types', 'transaction_types');
        Schema::rename('piano_uploaded_songs', 'songs');
        Schema::rename('piano_users_groups', 'user_groups');
        Schema::rename('piano_user_groups', 'groups');
        Schema::rename('piano_user_favorites', 'user_favorites');
        Schema::dropIfExists('category');
        Schema::dropIfExists('piano_ads');
        Schema::dropIfExists('piano_captcha');
        Schema::dropIfExists('piano_faq');
        Schema::dropIfExists('piano_log');
        Schema::dropIfExists('piano_music_schools');
        Schema::dropIfExists('piano_newsletter');
        Schema::dropIfExists('piano_orderers');
        Schema::dropIfExists('piano_recording_studios');
        Schema::dropIfExists('piano_requests');
        Schema::dropIfExists('piano_singing_groups');
        Schema::dropIfExists('piano_temp_katikati');
        Schema::dropIfExists('piano_temp_mwanzo');
        Schema::dropIfExists('piano_temp_nyinginezo');
        Schema::dropIfExists('piano_temp_posts');
        Schema::dropIfExists('piano_tshirt_orders');
        Schema::dropIfExists('productlines');
        Schema::dropIfExists('products');
        Schema::dropIfExists('customers');
        Schema::dropIfExists('employees');
        Schema::dropIfExists('film');
        Schema::dropIfExists('film_actor');
        Schema::dropIfExists('film_category');
        Schema::dropIfExists('offices');
        Schema::dropIfExists('orderdetails');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('payments');
        Schema::dropIfExists('actor');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::rename('categories', 'piano_categories');
        Schema::rename('composers', 'piano_composers');
        Schema::rename('users', 'piano_backend_users');
        Schema::rename('contributions', 'piano_contributions_account');
        Schema::rename('emails', 'piano_emails');
        Schema::rename('not_reviewed_reasons', 'piano_not_reviewed_reasons');
        Schema::rename('old_status', 'piano_old_status');
        Schema::rename('pages', 'piano_pages');
        Schema::rename('song_categories', 'piano_songs_categories');
        Schema::rename('song_downloads', 'piano_song_downloads');
        Schema::rename('daily_song_downloads', 'daily_downloads');
        Schema::rename('daily_song_views', 'daily_views');
        Schema::rename('song_statuses', 'piano_song_statuses');
        Schema::rename('song_views', 'piano_song_views');
        Schema::rename('transaction_types', 'piano_transaction_types');
        Schema::rename('songs', 'piano_uploaded_songs');
        Schema::rename('user_groups', 'piano_users_groups');
        Schema::rename('user_favorites', 'piano_user_favorites');
    }
}
