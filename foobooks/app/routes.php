<?php

/*-------------------------------------------------------------------------------------------------
// ! Index
-------------------------------------------------------------------------------------------------*/
Route::get('/', 'IndexController@getIndex');



/*-------------------------------------------------------------------------------------------------
// ! User
Explicit Routing
-------------------------------------------------------------------------------------------------*/
# Note: the beforeFilter for 'guest' on getSignup and getLogin is handled in the Controller
Route::get('/signup', 'UserController@getSignup'); 
Route::get('/login', 'UserController@getLogin' );
Route::post('/signup', ['before' => 'csrf', 'uses' => 'UserController@postSignup'] );
Route::post('/login', ['before' => 'csrf', 'uses' => 'UserController@postLogin'] );
Route::get('/logout', ['before' => 'auth', 'uses' => 'UserController@getLogout'] );


/*-------------------------------------------------------------------------------------------------
// ! Tag 
Implicit RESTful Routing
-------------------------------------------------------------------------------------------------*/
Route::resource('tag', 'TagController');


/*-------------------------------------------------------------------------------------------------
# ! Book
Explicit Routing
-------------------------------------------------------------------------------------------------*/
Route::get('/book', 'BookController@getIndex');
Route::get('/book/edit/{id}', 'BookController@getEdit');
Route::post('/book/edit/{id}', 'BookController@postEdit');
Route::get('/book/create', 'BookController@getCreate');
Route::post('/book/create', 'BookController@postCreate');

Route::get('/book/search', 'BookController@getSearch');
Route::post('/book/search', 'BookController@postSearch');


/*-------------------------------------------------------------------------------------------------
// ! Debug
Implicit
-------------------------------------------------------------------------------------------------*/
# Implicit routing
Route::controller('debug', 'DebugController');

/*
# Explicit routing
Route::get('/debug/', 'DebugController@index');
Route::get('/debug/trigger-error', 'Debug Controller@triggerError');
Route::get('/debug/books-json', 'DebugController@getBooksJson');
Route::get('/debug/routes', 'DebugController@routes');
*/


/*-------------------------------------------------------------------------------------------------
// ! Misc Demo
Explicit Routing
-------------------------------------------------------------------------------------------------*/
Route::get('/demo/csrf-example', 'DemoController@csrf');
Route::get('/demo/collections', 'DemoController@collections');
Route::get('/demo/js-vars', 'DemoController@jsVars');


/*-------------------------------------------------------------------------------------------------
// ! CRUD Demo
Explicit Routing
-------------------------------------------------------------------------------------------------*/
Route::get('/crud-create', 'DemoController@crudCreate');
Route::get('/crud-read', 'DemoController@crudRead');
Route::get('/crud-update', 'DemoController@crudUpdate');
Route::get('/crud-delete', 'DemoController@crudDelete');


/*-------------------------------------------------------------------------------------------------
// ! Queries Demo
Explicit Routing
-------------------------------------------------------------------------------------------------*/
Route::get('/collections', 'DemoController@collections');
Route::get('/query-without-constraints', 'DemoController@queryWithoutConstraints');
Route::get('/query-with-constraints', 'DemoController@queryWithConstraints');
Route::get('/query-responsibility', 'DemoController@queryResponsibility');
Route::get('/query-with-order', 'DemoController@queryWithOrder');


/*-------------------------------------------------------------------------------------------------
// ! Query Relationship Demos
Explicit Routing
-------------------------------------------------------------------------------------------------*/
Route::get('/query-relationships-author', 'DemoController@queryRelationshipsAuthor');
Route::get('/query-relationships-tags', 'DemoController@queryRelationshipstags');
Route::get('/query-eager-loading-authors', 'DemoController@queryEagerLoadingAuthors');
Route::get('/query-eager-loading-tags-and-authors', 'DemoController@queryEagerLoadingTagsAndAuthors');







