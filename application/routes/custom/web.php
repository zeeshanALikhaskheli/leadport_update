<?php

use App\Http\Controllers\LogisticsController;

/**----------------------------------------------------------------------------------------------------------------
 * [GROWCRM - CUSTOM ROUTES]
 * Place your custom routes or overides in this file. This file is not updated with Grow CRM updates
 * ---------------------------------------------------------------------------------------------------------------*/

 use App\Http\Controllers\Emails;
    //For Admin Panel
    Route::group(['prefix' => 'app-admin'], function () {

        Route::get('auth/redirect', "Landlord\GoogleController@redirectToGoogle");
        Route::get('callback', "Landlord\GoogleController@handleGoogleCallback");
        Route::get('eventss', "Landlord\GoogleController@viewEvents");
        Route::post('events/create', "Landlord\GoogleController@createEvent");
        Route::post('events/{id}/delete', "Landlord\GoogleController@deleteEvent");
        Route::post('events/update', "Landlord\GoogleController@updateEvent");
        Route::get('/auth/logout', "Landlord\GoogleController@logout");
    });

        Route::get('auth/redirect', "GoogleController@redirectToGoogle");
        Route::get('callback', "GoogleController@handleGoogleCallback");
        Route::get('eventss', "GoogleController@viewEvents");
        Route::post('events/create', "GoogleController@createEvent");
        Route::post('events/{id}/delete', "GoogleController@deleteEvent");
        Route::post('events/update', 'GoogleController@updateEvent');
        Route::get('/auth/logout', 'GoogleController@logout');
    



    Route::group(['prefix' => 'ctickets'], function () {

        Route::get('index', "TicketController@index")->name('ctickets.index');
      
 
        Route::get('create', "TicketController@create");
        Route::get('{id}/edit', "TicketController@edit");
        Route::get('{id}/view', "TicketController@view");
        Route::post('store', "TicketController@store");
        Route::post('{id}/delete-ticket', "TicketController@destroyTicket");
        Route::post('{id}/update-details', "TicketController@updateTicketDetails");
        Route::post('/generate-link', 'TicketController@generateLink');
        Route::get('form', "TicketController@ticketForm");
        Route::post('{id}/convartToLead', 'TicketController@convartToLead');

    });




 // Route for Emails Parser
Route::get('/emailsparser', [Emails::class, 'fetchEmails'])->name('emails.index');
// Route::get('/emailsparser/modal/{id}', [Emails::class, 'showModal'])->name('emails.modal');
Route::post('/emailsparser/modal/{id}', [Emails::class, 'loadEmailModal'])->name('emails.modal');
Route::get('/ctickets/fetch-logistics/{emailId}', [Emails::class, 'fetchLogistics']);
Route::post('/user/update-app-password', [Emails::class, 'updateAppPassword'])->name('user.updateAppPassword');


Route::get('/emailsparser/{email}/create', [Emails::class, 'show'])->name('emails.show');


// Route::get('/ctickets/index', [Emails::class, 'show'])->name('emails.show');



