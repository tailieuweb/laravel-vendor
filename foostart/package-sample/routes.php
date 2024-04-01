<?php

use Illuminate\Session\TokenMismatchException;

/**
 * USER
 */
Route::group(['middleware' => ['web', ], 'namespace' => 'Foostart\Contact\Controllers\User', ], function () {
    /**
    * list
    */
   Route::post('contact', [
       'as' => 'usercontact.post',
       'uses' => 'ContactUserController@post'
   ]);
});


/**
 * ADMINISTRATOR
 */
Route::group(['middleware' => ['web']], function () {


    Route::group(['middleware' => ['admin_logged', 'can_see', 'in_context'],
                  'namespace' => 'Foostart\Contact\Controllers\Admin',
        ], function () {

        /*
          |-----------------------------------------------------------------------
          | Manage contact
          |-----------------------------------------------------------------------
          | 1. List of contact
          | 2. Edit contact
          | 3. Delete contact
          | 4. Add new contact
          | 5. Manage configurations
          | 6. Manage languages
          |
        */

    });
});
