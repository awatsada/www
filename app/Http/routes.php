<?php  


Route::get('/', 'GuestbookController@reindex' );
// ========== Login and validation ============
Route::group(['middleware' => ['web']], function () {    
    Route::auth();
    Route::get('/home', 'GuestbookController@reindex');
    Route::get('guestbook', 'GuestbookController@reindex' );
    Route::get('guestbook/index', 'GuestbookController@index' );
    Route::post('guestbook/search', 'GuestbookController@search');
    Route::post('guestbook/addComment','GuestbookController@addComment');
    Route::get('guestbook/delete/{id}','GuestbookController@delete');
    Route::get('guestbook/edit/{id}','GuestbookController@editComment');
    Route::post('guestbook/saveComment/{id}','GuestbookController@saveComment');
 	Route::get('guestbook/searchTag/{id}', 'GuestbookController@searchTag');
 	Route::get('guestbook/contact', 'GuestbookController@contact');
 	Route::post('guestbook/submitEmail', 'GuestbookController@submitEmail');

});

 