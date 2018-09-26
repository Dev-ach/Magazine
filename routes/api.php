<?php

Route::group(['prefix' => '/v1', 'namespace' => 'Api\V1', 'as' => 'api.'], function () {

        Route::resource('articles', 'ArticlesController', ['except' => ['create', 'edit']]);

        Route::resource('categories', 'CategoriesController', ['except' => ['create', 'edit']]);

        Route::resource('commentaires', 'CommentairesController', ['except' => ['create', 'edit']]);

        Route::resource('tags', 'TagsController', ['except' => ['create', 'edit']]);

});
