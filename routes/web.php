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



Route::get('/search', 'HomeController@search')->name('search');
Route::get('/background', 'HomeController@background')->name('background');
Route::get('/background-view/{collection_id}', 'HomeController@background_view')->name('background.view');
Route::get('/download/{object_id}', 'HomeController@download')->name('download');

Route::get('/advanced_search', 'HomeController@advanced_search')->name('advanced_search');

Route::get('/results', 'HomeController@results')->name('results');
Route::get('/results-by', 'HomeController@results_by')->name('results_by');
Route::get('/results-by-name', 'HomeController@results_by_name')->name('results_by_name');
Route::get('/quick_results', 'HomeController@quick_results')->name('quick_results');
Route::get('/advanced_results', 'HomeController@advanced_results')->name('advanced_results');
Route::get('/search-by/{descritor}', 'HomeController@search_by')->name('search_by');

Route::get('/', 'HomeController@search')->name('search');
Route::post('/user-logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/user-perfil/{user_id}', 'HomeController@perfil')->name('user.perfil');
Route::post('/user-change_password', 'HomeController@change_password')->name('user.change_password');

Auth::routes();



Route::prefix('admin')->group(function() {
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::post('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
    Route::post('/register', 'Auth\AdminLoginController@register')->name('admin.register.submit');
    Route::post('/update', 'Auth\AdminLoginController@update')->name('admin.update');
    Route::post('/update-password', 'Auth\AdminLoginController@update_password')->name('admin.update_password');
    Route::get('/delete/{admin_id}', 'Auth\AdminLoginController@delete')->name('admin.delete');
    Route::get('/perfil/{admin_id}', 'Auth\AdminLoginController@perfil')->name('admin.perfil');
    Route::get('/', 'AdminController@index')->name('admin.dashboard');

    Route::get('/level', 'LevelController@index')->name('level');

    Route::post('/level-create', 'LevelController@create')->name('level.create');
    Route::post('/level-update', 'LevelController@update')->name('level.update');
    Route::get('/level-delete/{level_id}', 'LevelController@delete')->name('level.delete');

    Route::get('/type', 'TypeController@index')->name('type');    
    Route::post('/type-create', 'TypeController@create')->name('type.create');
    Route::post('/type-create_ajax', 'TypeController@create_ajax')->name('type.create_ajax');
    Route::post('/type-update', 'TypeController@update')->name('type.update');
    Route::post('/type-attach', 'TypeController@attach')->name('type.attach');
    Route::post('/type-detach', 'TypeController@detach')->name('type.detach');
    Route::get('/type-delete/{type_id}', 'TypeController@delete')->name('type.delete');
    Route::get('/type-delete_session', 'TypeController@delete_session')->name('type.delete_session');
    Route::get('/type-get_collections/{type_id}', 'TypeController@get_collections')->name('type.get_collections');

    Route::get('/subject', 'SubjectController@index')->name('subject');
    Route::post('/subject-create', 'SubjectController@create')->name('subject.create');
    Route::post('/subject-create_ajax', 'SubjectController@create_ajax')->name('subject.create_ajax');
    Route::post('/subject-update', 'SubjectController@update')->name('subject.update');
    Route::post('/subject-attach', 'SubjectController@attach')->name('subject.attach');
    Route::post('/subject-detach', 'SubjectController@detach')->name('subject.detach');
    Route::get('/subject-delete/{subject_id}', 'SubjectController@delete')->name('subject.delete');
    Route::get('/subject-delete_session', 'SubjectController@delete_session')->name('subject.delete_session');
    Route::get('/subject-get_collections/{subject_id}', 'SubjectController@get_collections')->name('subject.get_collections');

    Route::get('/producer', 'ProducerController@index')->name('producer');
    Route::post('/producer-create', 'ProducerController@create')->name('producer.create');
    Route::post('/producer-create_ajax', 'ProducerController@create_ajax')->name('producer.create_ajax');
    Route::post('/producer-update', 'ProducerController@update')->name('producer.update');
    Route::post('/producer-attach', 'ProducerController@attach')->name('producer.attach');
    Route::post('/producer-detach', 'ProducerController@detach')->name('producer.detach');
    Route::get('/producer-delete/{producer_id}', 'ProducerController@delete')->name('producer.delete');
    Route::get('/producer-delete_session', 'ProducerController@delete_session')->name('producer.delete_session');
    Route::get('/producer-get_collections/{producer_id}', 'ProducerController@get_collections')->name('producer.get_collections');

    Route::get('/local', 'LocalController@index')->name('local');
    Route::post('/local-create', 'LocalController@create')->name('local.create');
    Route::post('/local-create_ajax', 'LocalController@create_ajax')->name('local.create_ajax');
    Route::post('/local-update', 'LocalController@update')->name('local.update');
    Route::post('/local-attach', 'LocalController@attach')->name('local.attach');
    Route::post('/local-detach', 'LocalController@detach')->name('local.detach');
    Route::get('/local-delete/{local_id}', 'LocalController@delete')->name('local.delete');
    Route::get('/local-delete_session', 'LocalController@delete_session')->name('local.delete_session');
    Route::get('/local-get_collections/{local_id}', 'LocalController@get_collections')->name('local.get_collections');

    
    Route::get('/idiom', 'IdiomController@index')->name('idiom');
    Route::post('/idiom-create', 'IdiomController@create')->name('idiom.create');
    Route::post('/idiom-update', 'IdiomController@update')->name('idiom.update');
    Route::get('/idiom-delete/{idiom_id}', 'IdiomController@delete')->name('idiom.delete');
    Route::get('/idiom-delete_session', 'IdiomController@delete_session')->name('idiom.delete_session');
    Route::post('/idiom-attach', 'IdiomController@attach')->name('idiom.attach');
    Route::post('/idiom-detach', 'IdiomController@detach')->name('idiom.detach');
    Route::post('/idiom-create_ajax', 'IdiomController@create_ajax')->name('idiom.create_ajax');
    Route::get('/idiom-get_collections/{idiom_id}', 'IdiomController@get_collections')->name('idiom.get_collections');
    
    Route::post('/dimension-attach', 'DimensionController@attach')->name('dimension.attach');
    Route::post('/dimension-detach', 'DimensionController@detach')->name('dimension.detach');
    Route::post('/object-attach', 'ObjectController@attach')->name('object.attach');
    Route::post('/object-detach', 'ObjectController@detach')->name('object.detach');
    Route::get('/note-detach/{note_id}', 'NoteController@detach')->name('note.detach');

    Route::get('/collection-form', 'CollectionController@create_collection')->name('collection.form');
    Route::post('/collection-create', 'CollectionController@create')->name('collection.create');
    Route::post('/collection-create_child', 'CollectionController@create_child')->name('collection.create_child');
    Route::post('/collection-update', 'CollectionController@update')->name('collection.update');
    Route::get('/collection-level', 'CollectionController@form_level')->name('collection.form_level');
    Route::get('/collection-delete_session', 'CollectionController@delete_session')->name('collection.delete_session');
    Route::get('/collection-edit/{collection_id}', 'CollectionController@edit')->name('collection.edit');
    Route::get('/collection-view/{collection_id}', 'CollectionController@view')->name('collection.view');
    Route::get('/collection-delete/{collection_id}', 'CollectionController@delete')->name('collection.delete');
    Route::get('/collection-publish/{collection_id}', 'CollectionController@publish')->name('collection.publish');
    Route::get('/collection-publish_hierarchy/{collection_id}', 'CollectionController@publish_hierarchy')->name('collection.publish_hierarchy');
    Route::get('/collection-report', 'CollectionController@report')->name('collection.report');
    
    Route::get('/user', 'UserController@index')->name('user');
    Route::post('/user-update', 'UserController@update_user')->name('user.update');
    Route::post('/user-update_password', 'UserController@update_password')->name('user.update_password');
    Route::get('/user-delete/{user_id}', 'UserController@delete_user')->name('user.delete');
    

});
