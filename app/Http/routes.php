<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', [
    'as' => 'home',
    'uses' => 'Home\HomeController@index'
]);

Route::get('/auth/login',[
    'as' => 'login',
    'uses' => 'Auth\AuthController@loginGet'
]);

Route::post('/auth/login',[
    'as' => 'loginPost',
    'uses' => 'Auth\AuthController@loginPost'
]);

Route::get('/auth/register',[
    'as' => 'register',
    'uses' => 'Auth\AuthController@registerGet'
]);

Route::post('/auth/register',[
    'as' => 'registerPost',
    'uses' => 'Auth\AuthController@registerPost'
]);

Route::get('/home/locale/change', [
    'as' => 'change_locale',
    'uses' => 'Home\HomeController@changeLocale'
]);


// ------------------------------
// ROUTES FOR AUTHENTICATED USERS
// ------------------------------

Route::group(['middleware' => 'auth'],function(){

    Route::get('/logout',[
        'as' => 'logout',
        'uses' => 'Auth\AuthController@logout'
    ]);

    Route::get('/home', [
        'as' => 'homeLogged',
        'uses' => 'Auth\AuthController@redirectToProfile'
    ]);

    // ------------------------------
    // All the routes for citizens go here
    // ------------------------------

    Route::group(['middleware' => 'citizen'],function(){

        Route::get('/citizen/profile',[
            'as' => 'citizenProfile',
            'uses' => 'Citizen\CitizenProfileController@index'
        ]);

        Route::get('/citizen/appointment/{id}',[
            'as' => 'lawyer_appointment',
            'uses' => 'Citizen\CitizenProfileController@makeAppointment'
        ]);

        Route::post('/citizen/appointment/',[
            'as' => 'make_lawyer_appointment_post',
            'uses' => 'Citizen\CitizenProfileController@saveAppointment'
        ]);

        Route::get('/citizen/appointments/scheduled',[
            'as' => 'scheduled_appointments',
            'uses' => 'Citizen\CitizenProfileController@scheduledAppointments'
        ]);

        Route::get('/citizen/appointment/delete/{id}',[
            'as' => 'citizen_delete_appointment',
            'uses' => 'Citizen\CitizenProfileController@deleteAppointment'
        ]);

        Route::get('/citizen/appointment/edit/{id}',[
            'as' => 'edit_appointment',
            'uses' => 'Citizen\CitizenProfileController@editAppointment'
        ]);

        Route::post('/citizen/appointment/edit/save',[
            'as' => 'edit_appointment_save',
            'uses' => 'Citizen\CitizenProfileController@editAppointmentSave'
        ]);

        Route::get('/citizen/search/lawyers',[
            'as' => 'search_lawyers',
            'uses' => 'Citizen\CitizenProfileController@searchLawyers'
        ]);

        Route::post('/citizen/search/lawyers',[
            'as' => 'search_lawyers_post',
            'uses' => 'Citizen\CitizenProfileController@searchLawyersResults'
        ]);

        Route::get('/citizen/appointments/approved',[
            'as' => 'citizen_approved_appointments',
            'uses' => 'Citizen\CitizenProfileController@approvedAppointments'
        ]);

        Route::get('/citizen/appointments/rejected',[
            'as' => 'citizen_rejected_appointments',
            'uses' => 'Citizen\CitizenProfileController@rejectedAppointments'
        ]);

    });

    // ------------------------------
    // All the routes for lawyers go here
    // ------------------------------

    Route::group(['middleware' => 'lawyer'],function(){

        Route::get('/lawyer/profile',[
            'as' => 'lawyerProfile',
            'uses' => 'Lawyer\LawyerProfileController@index'
        ]);

        Route::get('/lawyer/appointments/reject/{id}',[
            'as' => 'lawyer_reject_appointment',
            'uses' => 'Lawyer\LawyerProfileController@rejectAppointment'
        ]);

        Route::get('/lawyer/appointments/approve/{id}',[
            'as' => 'lawyer_approve_appointment',
            'uses' => 'Lawyer\LawyerProfileController@approveAppointment'
        ]);

        Route::get('/lawyer/appointments/duplicates',[
            'as' => 'lawyer_duplicate_appointments',
            'uses' => 'Lawyer\LawyerProfileController@resolveDuplicateAppointments'
        ]);

    });

});