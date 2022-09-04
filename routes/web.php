<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttendeesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('index');
});


//client
/**
 * These routes perform actions related to clients
 */
Route::post('/clients/login', 'ClientsController@login');
Route::post('/clients/register', 'ClientsController@register');
Route::post('/clients/{id}/changepassword', 'ClientsController@change_password');

Route::get('/clients', ['middleware' => 'auth:client', 'uses' => 'ClientsController@get_all']);
Route::get('/clients/{id}', ['middleware' => 'auth:client', 'uses' => 'ClientsController@get_id']);

//put
Route::delete('/clients/{id}', 'ClientsController@delete_client');
Route::put('/clients/{id}', 'ClientsController@edit_client');


//conference
/**
 * These routes perform actions related to conferences
 */
    
Route::get('/conferences/', ['middleware' => 'auth:attendee', 'uses' => 'ConferencesController@get_all']);
//Route::get('/conferences/', 'ConferencesController@get_all');

Route::get('/conferences/{id}/speakers/', ['middleware' => 'auth:attendee', 'uses' => 'ConferencesController@get_conference_speakers']);
Route::get('/conferences/{id}', 'ConferencesController@get_id');
Route::get('/conferences/{id}/presentations/', ['middleware' => 'auth:attendee', 'uses' => 'ConferencesController@get_presentations']);
Route::get('/conferences/{id}/presentation/', ['middleware' => 'auth:attendee', 'uses' => 'ConferencesController@select_presentation']);
Route::get('/conferences/{id}/sponsors/', ['middleware' => 'auth:attendee', 'uses' => 'ConferencesController@get_sponsors']);



Route::post('/conferences/register', ['middleware' => 'auth:client', 'uses' => 'ConferencesController@register']);
Route::post('/conferences/{id}/presentations', 'ConferencesController@create_new_presentation');
Route::post('/conferences/{id}/sponsors', 'ConferencesController@create_new_sponsor');
Route::post('/conferences/{id}/blacklist', 'ConferencesController@add_to_blacklist');
Route::post('/conferences/{id}/whitelist', 'ConferencesController@add_to_whitelist');

    //works now
Route::delete('/conferences/{id}', 'ConferencesController@delete_conference');
Route::delete('/conferences/{id}/sponsors/', 'ConferencesController@delete_sponsor');
Route::delete('/conferences/{id}/blacklist', 'ConferencesController@remove_from_blacklist');    
Route::delete('/conferences/{id}/blacklist', 'ConferencesController@remove_from_whitelist');    

Route::put('/conferences/{id}', 'ConferencesController@edit_conferences');


//speakers
/**
 * These routes perform actions related to speakers
 */
Route::get('/speakers/', 'SpeakersController@get_all');
Route::get('/speakers/{id}', ['middleware' => 'auth:attendee', 'uses' => 'SpeakersController@get_id']);
Route::get('/speakers/{id}/presentations', 'SpeakersController@get_presentations');

Route::get('/speakers/{id}/conferences', 'SpeakersController@get_conference_speakers');

Route::delete('/speakers/{id}', 'SpeakersController@delete_speaker');
/*
Route::get('/speakers/', function() {   
    View::make('index'); // will return app/views/index.php 
});
*/

Route::post('/speakers/register', 'SpeakersController@create_new');


//Route::group(['prefix' => 'projects', 'middleware' => 'jwt.auth'], function($app) {
//    Route::post('/', 'App\Http\Controllers\ProjectsController@store');
//    Route::put('/{projectId}', 'App\Http\Controllers\ProjectsController@update');
//    Route::delete('/{projectId}', 'App\Http\Controllers\ProjectsController@destroy');
//});

//attendees
/**
 * These routes perform actions related to attendees
 */
Route::controller(AttendeesController::class)->group(function() {
    Route::post('/attendees/login', 'login');
    Route::post('/attendees/logout', 'logout');

    

    Route::post('/attendees/register', 'register');
    Route::post('/attendees/{id}/changepassword', 'change_password');
    Route::post('/attendees/{email}/forgotpassword', 'forgot_password');
    //Route::post('/password/email', 'PasswordController@postEmail');
    //Route::post('/password/reset/{token}', 'PasswordController@postReset');

    //Route::post('/attendees/{attendeeID}/conferences/{conferenceID}', 'AttendeesController@join_conference');
    Route::post('/attendees/{attendeeID}/conferences/{conferenceID}', ['middleware' => 'auth:attendee', 'uses' => 'join_conference']);

    Route::get('/attendees', 'get_all');
    Route::get('/attendees/{id}', 'get_id');
    //Route::get('/attendees/{id}/conferences', 'AttendeesController@get_conferences');
    Route::get('/attendees/{id}/conferences', ['middleware' => 'auth:attendee', 'uses' => 'get_conferences']);


    Route::delete('/attendees/{id}', 'delete_attendee');

    //put
    Route::put('/attendees/{id}', 'edit_attendee');

});
// Route::post('/attendees/login', 'AttendeesController@login');
// Route::post('/attendees/logout', 'AttendeesController@logout');

// Route::post('/auth/refresh-token', ['middleware' => 'jwt.refresh', function() {}]);

// Route::post('/attendees/register', 'AttendeesController@register');
// Route::post('/attendees/{id}/changepassword', 'AttendeesController@change_password');
// Route::post('/attendees/{email}/forgotpassword', 'AttendeesController@forgot_password');
// Route::post('/password/email', 'PasswordController@postEmail');
// Route::post('/password/reset/{token}', 'PasswordController@postReset');

// //Route::post('/attendees/{attendeeID}/conferences/{conferenceID}', 'AttendeesController@join_conference');
// Route::post('/attendees/{attendeeID}/conferences/{conferenceID}', ['middleware' => 'auth:attendee', 'uses' => 'AttendeesController@join_conference']);

// Route::get('/attendees', 'AttendeesController@get_all');
// Route::get('/attendees/{id}', 'AttendeesController@get_id');
// //Route::get('/attendees/{id}/conferences', 'AttendeesController@get_conferences');
// Route::get('/attendees/{id}/conferences', ['middleware' => 'auth:attendee', 'uses' => 'AttendeesController@get_conferences']);


// Route::delete('/attendees/{id}', 'AttendeesController@delete_attendee');

// //put
// Route::put('/attendees/{id}', 'AttendeesController@edit_attendee');



//categories
/**
 * These routes perform actions related to categories
 */
Route::get('/categories/', 'CategoryController@get_all');
Route::get('/categories/{id}', 'CategoryController@get_id');
Route::get('/categories/{id}/presentations', 'CategoryController@get_all');

Route::post('/categories/register', 'CategoryController@create_new');

Route::delete('/categories/{id}', 'CategoryController@delete_category');

Route::put('/categories/{id}', 'CategoryController@edit_category');


Route::group(['prefix' => 'admin'], function () {
//    Voyager::routes();
});
