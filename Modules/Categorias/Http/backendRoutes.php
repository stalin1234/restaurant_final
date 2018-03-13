<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/categorias'], function (Router $router) {
    $router->bind('news', function ($id) {
        return app('Modules\Categorias\Repositories\NewsRepository')->find($id);
    });
    $router->get('news', [
        'as' => 'admin.categorias.news.index',
        'uses' => 'NewsController@index',
        'middleware' => 'can:categorias.news.index'
    ]);
    $router->get('news/create', [
        'as' => 'admin.categorias.news.create',
        'uses' => 'NewsController@create',
        'middleware' => 'can:categorias.news.create'
    ]);
    $router->post('news', [
        'as' => 'admin.categorias.news.store',
        'uses' => 'NewsController@store',
        'middleware' => 'can:categorias.news.create'
    ]);
    $router->get('news/{news}/edit', [
        'as' => 'admin.categorias.news.edit',
        'uses' => 'NewsController@edit',
        'middleware' => 'can:categorias.news.edit'
    ]);
    $router->put('news/{news}', [
        'as' => 'admin.categorias.news.update',
        'uses' => 'NewsController@update',
        'middleware' => 'can:categorias.news.edit'
    ]);
    $router->delete('news/{news}', [
        'as' => 'admin.categorias.news.destroy',
        'uses' => 'NewsController@destroy',
        'middleware' => 'can:categorias.news.destroy'
    ]);
   
    $router->bind('category', function ($id) {
        return app('Modules\Categorias\Repositories\CategoryRepository')->find($id);
    });
    $router->get('categories', [
        'as' => 'admin.categorias.category.index',
        'uses' => 'CategoryController@index',
        'middleware' => 'can:categorias.categories.index'
    ]);
    $router->get('categories/create', [
        'as' => 'admin.categorias.category.create',
        'uses' => 'CategoryController@create',
        'middleware' => 'can:categorias.categories.create'
    ]);
    $router->post('categories', [
        'as' => 'admin.categorias.category.store',
        'uses' => 'CategoryController@store',
        'middleware' => 'can:categorias.categories.create'
    ]);
    $router->get('categories/{category}/edit', [
        'as' => 'admin.categorias.category.edit',
        'uses' => 'CategoryController@edit',
        'middleware' => 'can:categorias.categories.edit'
    ]);
    $router->put('categories/{category}', [
        'as' => 'admin.categorias.category.update',
        'uses' => 'CategoryController@update',
        'middleware' => 'can:categorias.categories.edit'
    ]);
    $router->delete('categories/{category}', [
        'as' => 'admin.categorias.category.destroy',
        'uses' => 'CategoryController@destroy',
        'middleware' => 'can:categorias.categories.destroy'
    ]);
// append

     $router->delete('categories/paginate}', [
        'as' => 'admin.categorias.category.paginate',
        'uses' => 'CategoryController@paginate',
        'middleware' => 'can:categorias.categories.index'
    ]);

   

});
