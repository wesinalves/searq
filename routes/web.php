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

Route::get('/results', function () {
	return view('results');
})->name('results');

Route::get('/search', function () {
	return view('search');
})->name('search');



Auth::routes();



Route::prefix('admin')->group(function() {
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::post('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
    Route::get('/register', 'Auth\AdminLoginController@showRegistrationForm')->name('admin.register');
    Route::post('/register', 'Auth\AdminLoginController@register')->name('admin.register.submit');
    Route::get('/', 'AdminController@index')->name('admin.dashboard');

    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/level', 'LevelController@index')->name('level');

    Route::post('/level-create', 'LevelController@create')->name('level.create');
    Route::post('/level-update', 'LevelController@update')->name('level.update');
    Route::get('/level-delete/{level_id}', 'LevelController@delete')->name('level.delete');

    Route::get('/type', 'TypeController@index')->name('type');    
    Route::post('/type-create', 'TypeController@create')->name('type.create');
    Route::post('/type-update', 'TypeController@update')->name('type.update');
    Route::post('/type-attach', 'TypeController@attach')->name('type.attach');
    Route::post('/type-detach', 'TypeController@detach')->name('type.detach');
    Route::get('/type-delete/{type_id}', 'TypeController@delete')->name('type.delete');

    Route::get('/subject', 'SubjectController@index')->name('subject');
    Route::post('/subject-create', 'SubjectController@create')->name('subject.create');
    Route::post('/subject-update', 'SubjectController@update')->name('subject.update');
    Route::post('/subject-attach', 'SubjectController@attach')->name('subject.attach');
    Route::post('/subject-detach', 'SubjectController@detach')->name('subject.detach');
    Route::get('/subject-delete/{subject_id}', 'SubjectController@delete')->name('subject.delete');

    Route::get('/producer', 'ProducerController@index')->name('producer');
    Route::post('/producer-create', 'ProducerController@create')->name('producer.create');
    Route::post('/producer-update', 'ProducerController@update')->name('producer.update');
    Route::post('/producer-attach', 'ProducerController@attach')->name('producer.attach');
    Route::post('/producer-detach', 'ProducerController@detach')->name('producer.detach');
    Route::get('/producer-delete/{producer_id}', 'ProducerController@delete')->name('producer.delete');

    Route::get('/local', 'LocalController@index')->name('local');
    Route::post('/local-create', 'LocalController@create')->name('local.create');
    Route::post('/local-update', 'LocalController@update')->name('local.update');
    Route::post('/local-attach', 'LocalController@attach')->name('local.attach');
    Route::post('/local-detach', 'LocalController@detach')->name('local.detach');
    Route::get('/local-delete/{local_id}', 'LocalController@delete')->name('local.delete');

    Route::post('/idiom-attach', 'IdiomController@attach')->name('idiom.attach');
    Route::post('/idiom-detach', 'IdiomController@detach')->name('idiom.detach');
    Route::post('/dimension-attach', 'DimensionController@attach')->name('dimension.attach');
    Route::post('/dimension-detach', 'DimensionController@detach')->name('dimension.detach');
    Route::post('/object-attach', 'ObjectController@attach')->name('object.attach');
    Route::post('/object-detach', 'ObjectController@detach')->name('object.detach');
    Route::get('/note-detach/{note_id}', 'NoteController@detach')->name('note.detach');

    Route::get('/collection-form', 'CollectionController@create_collection')->name('collection.form');
    Route::post('/collection-create', 'CollectionController@create')->name('collection.create');
    Route::post('/collection-update', 'CollectionController@update')->name('collection.update');
    Route::post('/collection-level', 'CollectionController@form_level')->name('collection.form_level');
    Route::get('/collection-edit/{collection_id}', 'CollectionController@edit')->name('collection.edit');
    Route::get('/collection-view/{collection_id}', 'CollectionController@view')->name('collection.view');
    Route::get('/collection-delete/{collection_id}', 'CollectionController@delete')->name('collection.delete');
    Route::get('/collection-publish/{collection_id}', 'CollectionController@publish')->name('collection.publish');

});
