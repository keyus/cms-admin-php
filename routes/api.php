<?php

/**
 * 此路由文件下所有路由，会进行api前缀绑定
 */

/**登陆校验 */

Route::post('auth/login', 'Api\AuthController@login');

Route::middleware(['middleware' => 'auth:api'])
// Route::middleware([])
    ->group(function () {
        //登出
        Route::post('auth/logout', 'Api\AuthController@logout');

        //图片上传
        Route::post('image/upload', 'Api\ImageController@upload');

        //会员中心
        Route::post('member', 'Api\MemberController@list');
        Route::post('member/delete', 'Api\MemberController@delete');
        Route::post('member/add', 'Api\MemberController@add');
        Route::post('member/edit', 'Api\MemberController@edit');

        //会员中心-交易账户
        Route::post('member/account', 'Api\MemberAccountController@list');
        Route::post('member/account/delete', 'Api\MemberAccountController@delete');
        Route::post('member/account/add', 'Api\MemberAccountController@add');
        Route::post('member/account/edit', 'Api\MemberAccountController@edit');

        //会员中心-资金记录
        Route::post('member/money', 'Api\MemberMoneyController@list');
        Route::post('member/money/delete', 'Api\MemberMoneyController@delete');
        Route::post('member/money/add', 'Api\MemberMoneyController@add');
        Route::post('member/money/edit', 'Api\MemberMoneyController@edit');

        //会员中心-资金记录
        Route::post('member/open', 'Api\MemberOpenController@list');
        Route::post('member/open/delete', 'Api\MemberOpenController@delete');
        Route::post('member/open/add', 'Api\MemberOpenController@add');
        Route::post('member/open/edit', 'Api\MemberOpenController@edit');

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

        //广告栏位
        Route::post('ad', 'Api\AdController@list');
        Route::post('ad/delete', 'Api\AdController@delete');
        Route::post('ad/add', 'Api\AdController@add');
        Route::post('ad/edit', 'Api\AdController@edit');

        //广告内容
        Route::post('adContent', 'Api\AdContentController@list');
        Route::post('adContent/delete', 'Api\AdContentController@delete');
        Route::post('adContent/add', 'Api\AdContentController@add');
        Route::post('adContent/edit', 'Api\AdContentController@edit');

        //站点基本信息
        Route::post('site', 'Api\SiteController@list');
        Route::post('site/edit', 'Api\SiteController@edit');

         //下载管理
         Route::post('download', 'Api\DownloadController@list');
         Route::post('download/delete', 'Api\DownloadController@delete');
         Route::post('download/add', 'Api\DownloadController@add');
         Route::post('download/edit', 'Api\DownloadController@edit');

         //首页配置
         Route::post('config/index', 'Api\ConfigIndexController@index');
         Route::post('config/index/edit', 'Api\ConfigIndexController@edit');
         //内容页配置
         Route::post('config/content', 'Api\ConfigContentController@index');
         Route::post('config/content/edit', 'Api\ConfigContentController@edit');
    });
