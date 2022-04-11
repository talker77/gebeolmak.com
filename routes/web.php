<?php

Route::get('test', 'TestController@index');

Route::group(['middleware' => 'site.config'], function () {
    //social auth
    Route::get('/redirect/{service}', 'SocialAuthController@redirect');
    Route::get('/callback/{service}', 'SocialAuthController@callback');


    // İnitial routes
    Route::get('hakkimizda', 'AnasayfaController@about')->name('about');
    Route::get('iletisim', 'IletisimController@index')->name('contact');
    Route::post('iletisim', 'IletisimController@sendMail')->name('contact.post')->middleware(['throttle:1231,10']);
    Route::get('sss', 'SSSController@list')->name('sss');
    Route::post('referanslar', 'ReferenceController@list')->name('referanslar');

    Route::get('blog/{blog:slug}', 'BlogController@detail')->name('blog.detail');
    Route::post('blog/comment/{blog:id}', 'BlogController@createComment')->name('blog.comment.store');
    Route::get('kategori/{category:slug}', 'CategoryController@detail')->name('category.detail');
    Route::get('galeri/{gallery:slug}', 'GaleriController@detail')->name('gallery.detail');
    Route::post('createBulten', 'EBultenController@createEBulten')->name('ebulten.create')->middleware(['throttle:3,10']);

    Route::get('/', 'AnasayfaController@index')->name('homeView');
    Route::get('/sitemap.xml', 'AnasayfaController@sitemap');
    Route::get('/ara', 'AramaController@ara')->name('search');
    Route::get('/searchPageFilter', 'AramaController@searchPageFilterWithAjax');
    Route::get('/headerSearchBarOnChangeWithAjax', 'AramaController@headerSearchBarOnChangeWithAjax');

    //---------- User Routes ----------------------
    Route::group(['prefix' => 'kullanici'], function () {
        // auth
        Route::get('/giris', 'KullaniciController@loginForm')->name('user.login');
        Route::post('/giris', 'KullaniciController@login');
        Route::post('/cikis', 'KullaniciController@logout')->name('user.logout');
        Route::get('/kayit', 'KullaniciController@registerForm')->name('user.register');
        Route::post('/kayit', 'KullaniciController@register')->middleware('throttle:10');
        Route::get('/aktiflestir/{activation_code}', 'KullaniciController@activateUser');

        // User
        Route::group(['middleware' => 'auth'], function () {
            Route::get('hesabim', 'AccountController@dashboard')->name('user.dashboard');
            Route::post('profil', 'AccountController@userDetailSave')->name('user.detail');
            Route::put('change-password', 'AccountController@changePassword')->name('user.change-password');
        });

    });

    Route::group([ 'namespace' => 'Forum', 'prefix' => 'forum'], function () {
        Route::get('/', 'HomeController@index')->name('forum.index');
        Route::get('/konu/{forum:slug}', 'ForumController@show')->name('forum.detail');
        Route::group(['middleware' => 'auth'],function (){
            // todo : izlemeye alınan forumlar listelencek
            Route::get('me/watches', 'ForumWatchesController@index')->name('forum.watches');
            Route::post('me/watch/{forum:id}', 'ForumWatchesController@store')->name('forum.watches.store');
            Route::get('me/posts', 'ForumController@forums')->name('forum.posts');


            Route::get('create','ForumController@create')->name('forum.create');
            Route::post('store','ForumController@store')->name('forum.store');
            // todo : izlemeye alınacak
            Route::post('follow/{forum:id}','ForumController@follow')->name('forum.follow');
            Route::post('comment/{forum:id}/{replied:id?}','ForumCommentController@store')->name('forum.comment.store');
        });
        Route::get('{category:slug}', 'HomeController@category')->name('forum.category');
    });
    Route::group(['prefix' => 'locations'], function () {
        Route::get('/getTownsByCityId/{cityId}', 'CityTownController@getTownsByCityId')->name('cityTownService.getTownsByCityId');
    });

    //Password Reset Routes...
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.reset');


    Route::get('lang/{locale}', 'AnasayfaController@setLanguage')->name('home.setLocale');
    Route::get('{content:slug}', 'ContentController@detail')->name('content.detail');
});
