<?php

Route::name('api.')->group(function () {
    //图片上传
    Route::post('image/upload', 'Api\ImageController@upload');

    //管理员
    Route::post('admin', 'Api\AdminController@list');
    Route::post('admin/delete', 'Api\AdminController@delete');
    Route::post('admin/add', 'Api\AdminController@add');
    Route::post('admin/edit', 'Api\AdminController@edit');

    //栏目
    Route::post('channel', 'Api\ChannelController@list');
    Route::post('channel/get', 'Api\ChannelController@get');
    Route::post('channel/delete', 'Api\ChannelController@delete');
    Route::post('channel/add', 'Api\ChannelController@add');
    Route::post('channel/edit', 'Api\ChannelController@edit');
    Route::post('channel/edit/advance', 'Api\ChannelController@editAdvance');
    Route::post('channel/edit/content', 'Api\ChannelController@editContent');

    //文章
    Route::post('article', 'Api\ArticleController@list');
    Route::post('article/get', 'Api\ArticleController@get');
    Route::post('article/delete', 'Api\ArticleController@delete');
    Route::post('article/add', 'Api\ArticleController@add');
    Route::post('article/edit', 'Api\ArticleController@edit');
    Route::post('article/edit/advance', 'Api\ArticleController@editAdvance');
    Route::post('article/edit/content', 'Api\ArticleController@editContent');

     //友情链接
    Route::post('links', 'Api\LinksController@list');
    Route::post('links/delete', 'Api\LinksController@delete');
    Route::post('links/add', 'Api\LinksController@add');
    Route::post('links/edit', 'Api\LinksController@edit');
});
