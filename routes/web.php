<?php
Route::get('/admin', function () { return redirect('/admin/articles'); });
Route::get('/', 'Api\V1\ArticlesController@index');
Route::get('/categorie/{categorie}', 'Api\V1\ArticlesController@categorieIndex');
Route::get('/article/{id}', 'Api\V1\ArticlesController@show');
Route::post('commentaire','Api\V1\CommentairesController@store');
Route::post('/video', 'VideoController@store');

Route::get('/test', 'Api\V1\ArticlesController@test');

Route::post('recherche','Api\V1\ArticlesController@cherche');
// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('auth.login');
$this->post('login', 'Auth\LoginController@login')->name('auth.login');
$this->post('logout', 'Auth\LoginController@logout')->name('auth.logout');

// Change Password Routes...
$this->get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
$this->patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('auth.password.reset');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('auth.password.reset');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset')->name('auth.password.reset');

Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/home', 'HomeController@index');
    
    Route::resource('roles', 'Admin\RolesController');
    Route::post('roles_mass_destroy', ['uses' => 'Admin\RolesController@massDestroy', 'as' => 'roles.mass_destroy']);
    Route::resource('users', 'Admin\UsersController');
    Route::post('users_mass_destroy', ['uses' => 'Admin\UsersController@massDestroy', 'as' => 'users.mass_destroy']);
    Route::resource('articles', 'Admin\ArticlesController');
    Route::post('articles_mass_destroy', ['uses' => 'Admin\ArticlesController@massDestroy', 'as' => 'articles.mass_destroy']);
    Route::post('articles_restore/{id}', ['uses' => 'Admin\ArticlesController@restore', 'as' => 'articles.restore']);
    Route::delete('articles_perma_del/{id}', ['uses' => 'Admin\ArticlesController@perma_del', 'as' => 'articles.perma_del']);
    Route::resource('categories', 'Admin\CategoriesController');
    Route::post('categories_mass_destroy', ['uses' => 'Admin\CategoriesController@massDestroy', 'as' => 'categories.mass_destroy']);
    Route::post('categories_restore/{id}', ['uses' => 'Admin\CategoriesController@restore', 'as' => 'categories.restore']);
    Route::delete('categories_perma_del/{id}', ['uses' => 'Admin\CategoriesController@perma_del', 'as' => 'categories.perma_del']);
    Route::resource('commentaires', 'Admin\CommentairesController');
    Route::post('commentaires_mass_destroy', ['uses' => 'Admin\CommentairesController@massDestroy', 'as' => 'commentaires.mass_destroy']);
    Route::post('commentaires_restore/{id}', ['uses' => 'Admin\CommentairesController@restore', 'as' => 'commentaires.restore']);
    Route::delete('commentaires_perma_del/{id}', ['uses' => 'Admin\CommentairesController@perma_del', 'as' => 'commentaires.perma_del']);
    Route::resource('tags', 'Admin\TagsController');
    Route::post('tags_mass_destroy', ['uses' => 'Admin\TagsController@massDestroy', 'as' => 'tags.mass_destroy']);
    Route::post('tags_restore/{id}', ['uses' => 'Admin\TagsController@restore', 'as' => 'tags.restore']);
    Route::delete('tags_perma_del/{id}', ['uses' => 'Admin\TagsController@perma_del', 'as' => 'tags.perma_del']);



 
});
