<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);


/* Login routes */

Route::group(['prefix' => 'auth'], function () {

    Route::get('login', ['as' => 'getLogin', 'uses' => 'LoginController@getLogin']);
    Route::post('login', ['as' => 'postLogin', 'uses' => 'LoginController@postLogin']);
    Route::get('logout', ['as' => 'logout', 'uses' => 'LoginController@getLogout']);

});


/* Admin routes */


Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('dashboard', ['as' => 'adminDashboard', 'uses' => 'AdminController@index']);

    /* Blog post administration */

    Route::group(['prefix' => 'posts'], function () {
        Route::get('dashboard', ['as' => 'postsDashboard', 'uses' => 'BlogController@indexAdmin']);

        Route::get('create_new', ['as' => 'getCreateBlogPost', 'uses' => 'BlogController@getCreateOrUpdate']);
        Route::post('create_new', ['as' => 'postCreateBlogPost', 'uses' => 'BlogController@postCreateOrUpdate']);

        Route::get('update/{id}', ['as' => 'getUpdateBlogPost', 'uses' => 'BlogController@getCreateOrUpdate'])
            ->where('id', '[0-9]+');
        Route::post('update/{id}', ['as' => 'postUpdateBlogPost', 'uses' => 'BlogController@postCreateOrUpdate'])
            ->where('id', '[0-9]+');

        Route::get('delete/{id}', ['as' => 'getDeleteBlogPost', 'uses' => 'BlogController@getDelete'])
            ->where('id', '[0-9]+');

        Route::get('publish/{id}', ['as' => 'getPublishBlogPost', 'uses' => 'BlogController@getPublish'])
            ->where('id', '[0-9]+');
        Route::get('unpublish/{id}', ['as' => 'getUnpublishBlogPost', 'uses' => 'BlogController@getUnpublish'])
            ->where('id', '[0-9]+');
    });

    /* Blog category administration */

    Route::group(['prefix' => 'categories'], function () {
        Route::get('dashboard', ['as' => 'categoriesDashboard', 'uses' => 'BlogController@indexAdmin']);
    });

    /* Blog authors administration */

    Route::group(['prefix' => 'authors'], function () {
        Route::get('dashboard', ['as' => 'authorsDashboard', 'uses' => 'AuthorController@index']);
    });


    /* Pages administration*/

    Route::group(['prefix' => 'pages'], function () {
        Route::get('dashboard', ['as' => 'pagesDashboard', 'uses' => 'PageController@indexAdmin']);


        Route::get('create_new', ['as' => 'getCreatePage', 'uses' => 'PageController@getCreateOrUpdate']);
        Route::post('create_new', ['as' => 'postCreatePage', 'uses' => 'PageController@postCreateOrUpdate']);

        Route::get('update/{id}', ['as' => 'getUpdatePage', 'uses' => 'PageController@getCreateOrUpdate'])
            ->where('id', '[0-9]+');
        Route::post('update/{id}', ['as' => 'postUpdatePage', 'uses' => 'PageController@postCreateOrUpdate'])
            ->where('id', '[0-9]+');

        Route::get('delete/{id}', ['as' => 'getDeletePage', 'uses' => 'PageController@getDelete'])
            ->where('id', '[0-9]+');

        Route::get('publish/{id}', ['as' => 'getPublishPage', 'uses' => 'PageController@getPublish'])
            ->where('id', '[0-9]+');
        Route::get('unpublish/{id}', ['as' => 'getUnpublishPage', 'uses' => 'PageController@getUnpublish'])
            ->where('id', '[0-9]+');
    });

    /* Comments administration*/

    Route::group(['prefix' => 'comments'], function () {
        Route::get('dashboard', ['as' => 'commentsDashboard', 'uses' => 'CommentsController@indexAdmin']);

        Route::get('update/{id}', ['as' => 'getUpdateComment', 'uses' => 'CommentsController@getCreateOrUpdate'])
            ->where('id', '[0-9]+');
        Route::post('update/{id}', ['as' => 'postUpdateComment', 'uses' => 'CommentsController@postCreateOrUpdate'])
            ->where('id', '[0-9]+');

        Route::get('delete/{id}', ['as' => 'getDeleteComment', 'uses' => 'CommentsController@getDelete'])
            ->where('id', '[0-9]+');

        Route::get('publish/{id}', ['as' => 'getPublishComment', 'uses' => 'CommentsController@getPublish'])
            ->where('id', '[0-9]+');
        Route::get('unpublish/{id}', ['as' => 'getUnpublishComment', 'uses' => 'CommentsController@getUnpublish'])
            ->where('id', '[0-9]+');
    });

    /* Settings pages */

    Route::group(['prefix' => 'settings'], function () {
        Route::get('/', ['as' => 'adminSettings', 'uses' => 'SettingsController@index']);

    });

});

/* Blog routes */

Route::group(['prefix' => 'blog'], function () {
    Route::get('/', ['as' => 'blog', 'uses' => 'BlogController@indexBlog']);
    Route::get('/{id}-{url}', ['as' => 'blogPost', 'uses' => 'BlogController@getBlogPost'])
        ->where('id', '[0-9]+')
        ->where('url', '[0-9, a-z, A-Z, \-]+');

    Route::group(['prefix' => 'category'], function () {
        Route::get('/{id}-{url}', ['as' => 'blogCategory', 'uses' => 'BlogController@indexBlog'])
            ->where('id', '[0-9]+')
            ->where('url', '[0-9, a-z, A-Z, \-]+');
    });

    Route::post('comment', ['as' => 'postComment', 'uses' => 'BlogController@postComment']);
});


/* Static pages routes */

Route::get('/{url}', ['as' => 'staticPage', 'uses' => 'PageController@getPage'])
    ->where('url', '[0-9, a-z, A-Z, \-]+');

