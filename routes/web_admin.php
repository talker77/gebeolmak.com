<?php

/*
|--------------------------------------------------------------------------
| Web Admin Routes
|--------------------------------------------------------------------------
|
 */

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::redirect('', '/admin/giris/');
//    Route::match(['get', 'post'], 'giris', 'AuthController@login')->name('admin.login');
    Route::get('giris', 'AuthController@loginView')->name('admin.login');
    Route::post('giris', 'AuthController@login')->name('admin.login.post');
    Route::get('/clear_cache', 'AnasayfaController@cacheClear')->name('admin.clearCache');
    Route::group(['middleware' => ['admin', 'admin.module', 'role', 'admin.language', 'admin.counts', 'admin.data']], function () {
        Route::get('home', 'AnasayfaController@index')->name('admin.home_page');
        Route::get('contacts', 'AnasayfaController@contacts')->name('admin.contacts');
        Route::get('cikis', 'AuthController@logout')->name('admin.logout');

        //----- Admin/User/..
        Route::group(['prefix' => 'user/'], function () {
            Route::get('/', 'UserController@index')->name('admin.users');
            Route::get('create', 'UserController@create')->name('admin.user.create');
            Route::get('edit/{user:id}', 'UserController@edit')->name('admin.user.edit');
            Route::post('', 'UserController@store')->name('admin.user.store');
            Route::put('{user:id}', 'UserController@update')->name('admin.user.update');
            Route::delete('{user:id}', 'UserController@delete')->name('admin.user.delete');
        });

        //----- Admin/Category/..
        Route::group(['prefix' => 'category/'], function () {
            Route::get('/', 'CategoryController@index')->name('admin.categories.index');
            Route::get('{category:id}/sub-categories', 'CategoryController@subCategories')->name('admin.categories.sub-categories');
            Route::get('type', 'CategoryController@categoriesByType')->name('admin.categories.categories-by-type');
            Route::get('create', 'CategoryController@create')->name('admin.categories.create');
            Route::get('{category:id}', 'CategoryController@show')->name('admin.categories.edit');
            Route::post('', 'CategoryController@store')->name('admin.categories.store');
            Route::put('{category:id}', 'CategoryController@update')->name('admin.categories.update');
            Route::delete('{category:id}', 'CategoryController@delete')->name('admin.categories.delete');
        });


        // Adverts
        Route::resource('adverts', 'AdvertController', ['as' => 'admin']);


        //----- Admin/Banners/..
        Route::group(['prefix' => 'banner/'], function () {
            Route::get('/', 'BannerController@list')->name('admin.banners');
            Route::get('new', 'BannerController@edit')->name('admin.banners.new');
            Route::get('edit/{banner:id}', 'BannerController@edit')->name('admin.banners.edit');
            Route::post('save/{id}', 'BannerController@save')->name('admin.banners.save');
            Route::delete('{banner:id}', 'BannerController@delete')->name('admin.banners.delete');
        });

        //----- Admin/Configs/..
        Route::group(['prefix' => 'configs/'], function () {
            Route::get('list', 'AyarlarController@list')->name('admin.config.list');
            Route::get('show/{id}', 'AyarlarController@show')->name('admin.config.show');
            Route::post('save/{id}', 'AyarlarController@save')->name('admin.config.save');

            Route::resource('cargo', 'CargoController', ['as' => 'admin']);
        });

        //----- Admin/Logs/..
        Route::group(['prefix' => 'logs/'], function () {
            Route::get('/', 'LogController@list')->name('admin.logs');
            Route::get('show/{id}', 'LogController@show')->name('admin.log.show');
            Route::get('json/{log:id}', 'LogController@json')->name('admin.log.json');
            Route::get('delete/{id}', 'LogController@delete')->name('admin.log.delete');
            Route::get('deleteAll', 'LogController@deleteAll')->name('admin.log.delete_all');
        });


        //----- Admin/Coupons/..
        Route::group(['prefix' => 'sss/'], function () {
            Route::get('/', 'SSSController@list')->name('admin.sss');
            Route::get('new', 'SSSController@newOrEditForm')->name('admin.sss.new');
            Route::get('edit/{id}', 'SSSController@newOrEditForm')->name('admin.sss.edit');
            Route::post('save/{id}', 'SSSController@save')->name('admin.sss.save');
            Route::get('delete/{id}', 'SSSController@delete')->name('admin.sss.delete');
        });

        //----- Admin/PhotoGallery/..
        Route::group(['prefix' => 'photo-gallery/'], function () {
            Route::get('/', 'FotoGalleryController@list')->name('admin.gallery');
            Route::get('new', 'FotoGalleryController@newOrEditForm')->name('admin.gallery.new');
            Route::get('edit/{id}', 'FotoGalleryController@newOrEditForm')->name('admin.gallery.edit');
            Route::post('save/{id}', 'FotoGalleryController@save')->name('admin.gallery.save');
            Route::get('delete/{id}', 'FotoGalleryController@delete')->name('admin.gallery.delete');
            Route::get('deleteGalleryImage/{id}', 'FotoGalleryController@deleteGalleryImage')->name('admin.gallery.image.delete');
        });
        //----- Admin/Content/..
        Route::group(['prefix' => 'content/'], function () {
            Route::get('/', 'ContentController@index')->name('admin.content');
            Route::get('new', 'ContentController@create')->name('admin.content.new');
            Route::get('{content:id}', 'ContentController@create')->name('admin.content.edit');
            Route::post('{content:id}', 'ContentController@save')->name('admin.content.save');
            Route::delete('{content:id}', 'ContentController@delete')->name('admin.content.delete');
        });
        //----- Admin/Roles/..
        Route::group(['prefix' => 'roles/'], function () {
            Route::get('/', 'RoleController@list')->name('admin.roles');
            Route::get('new', 'RoleController@newOrEditForm')->name('admin.role.new');
            Route::get('edit/{id}', 'RoleController@newOrEditForm')->name('admin.role.edit');
            Route::post('save/{id}', 'RoleController@save')->name('admin.role.save');
            Route::get('delete/{id}', 'RoleController@delete')->name('admin.role.delete');
        });
        //----- Admin/Blog/..
        Route::group(['prefix' => 'blog'], function () {
            Route::get('/', 'BlogController@index')->name('admin.blog');
            Route::get('new', 'BlogController@create')->name('admin.blog.new');
            Route::get('edit/{blog:id}', 'BlogController@edit')->name('admin.blog.edit');
            Route::put('{blog:id}', 'BlogController@update')->name('admin.blog.update');
            Route::post('', 'BlogController@store')->name('admin.blog.store');
            Route::delete('{blog:id}', 'BlogController@delete')->name('admin.blog.delete');
        });
        //----- Admin/Forum/..
        Route::group(['prefix' => 'forum'], function () {
            Route::get('/', 'ForumController@index')->name('admin.forum');
            Route::get('new', 'ForumController@create')->name('admin.forum.new');
            Route::get('edit/{forum:id}', 'ForumController@edit')->name('admin.forum.edit');
            Route::put('{forum:id}', 'ForumController@update')->name('admin.forum.update');
            Route::post('', 'ForumController@store')->name('admin.forum.store');
            Route::delete('{forum:id}', 'ForumController@delete')->name('admin.forum.delete');

            Route::group(['prefix' => 'comments'], function () {
                Route::get('/', 'ForumCommentController@index')->name('admin.forum.comment');
                Route::get('new', 'ForumCommentController@create')->name('admin.forum.comment.new');
                Route::get('edit/{comment:id}', 'ForumCommentController@show')->name('admin.forum.comment.edit');
                Route::put('{comment:id}', 'ForumCommentController@update')->name('admin.forum.comment.update');
                Route::post('', 'ForumCommentController@store')->name('admin.forum.comment.store');
                Route::delete('{comment:id}', 'ForumCommentController@delete')->name('admin.forum.comment.delete');
            });
        });
        //----- Admin/EBulten/..
        Route::group(['prefix' => 'ebulten/'], function () {
            Route::get('/', 'EBultenController@list')->name('admin.ebulten');
            Route::get('delete/{id}', 'EBultenController@delete')->name('admin.ebulten.delete');
        });
        //----- Admin/Contact/..
        Route::group(['prefix' => 'contact/'], function () {
            Route::get('/', 'ContactController@list')->name('admin.contact');
            Route::get('ajax', 'ContactController@ajax')->name('admin.contact.ajax');
            Route::get('delete/{contact:id}', 'ContactController@delete')->name('admin.contact.delete');
        });
        //---- Admin/Locations/......
        Route::group(['prefix' => 'locations'], function () {
            Route::get('/countries', 'RegionController@countries')->name('regions.countries');
            Route::get('/state/{country:id}', 'RegionController@getStatesByCountry')->name('regions.states');
            Route::get('/neighborhoods/{state:id}', 'RegionController@getNeighborhoodByState')->name('regions.neighborhoods');
        });

        //----- Admin/Tables/..
        Route::group(['prefix' => 'tables/'], function () {
            Route::get('users', 'TableController@users')->name('admin.tables.users');
            Route::get('blogs', 'TableController@blogs')->name('admin.tables.blogs');
            Route::get('companies', 'TableController@companies')->name('admin.tables.companies');
            Route::get('categories', 'TableController@categories')->name('admin.tables.categories');
            Route::get('contents', 'TableController@contents')->name('admin.tables.contents');
            Route::get('banners', 'TableController@banners')->name('admin.tables.banners');
            Route::get('forums', 'TableController@forums')->name('admin.tables.forums');
            Route::get('forum-comments', 'TableController@forumComments')->name('admin.tables.forums.comments');
        });

        //----- Admin/Images/----
        Route::delete('images/{image:id}', [\App\Http\Controllers\Admin\ImageController::class, 'delete']);
    });
});

Route::get('/home', 'AnasayfaController@index')->name('home');
