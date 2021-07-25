<?php


use Illuminate\Support\Facades\Route;

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

Route::get('/','WelcomeController@path');
Route::get('/visitor', 'WelcomeController@index');

//base halaman ke spesifik museum
Route::get('/{namamuseum}', 'MuseumControllers\MuseumController@index');

/*dari halaman home museum ke sub halaman dari museum itu

1.halaman event
2.halaman collection
3.halaman information
*/

//admin register dan login page dan logout page
Route::get('/admin/login','AdminControllers\Auth\LoginController@index')->name('login');
Route::post('/admin/login','AdminControllers\Auth\LoginController@store');
Route::get('/admin/register','AdminControllers\Auth\registerController@index');
Route::post('/admin/register','AdminControllers\Auth\registerController@store');
Route::post('/admin/logout','AdminControllers\Auth\LogoutController@store');

/*-----******admin starter page*****-----
----------------------------------------
----------------------------------------
--------------------------------------*/

Route::get('/admin/afterlogin', 'AdminControllers\AdminController@index')->name('dashboard');

//page untuk insert data super admin
Route::get('/admin/newmuseum','AdminControllers\AdminControllersSub\NewMuseumController@index');
Route::get('/admin/newevent','AdminControllers\AdminControllersSub\NewEventController@index');
Route::get('/admin/newcollection','AdminControllers\AdminControllersSub\NewCollectionController@index');
Route::get('/admin/newschedule','AdminControllers\AdminControllersSub\NewScheduleController@index');
Route::get('/admin/newticket','AdminControllers\AdminControllersSub\NewTicketController@index');
Route::get('/admin/newbooking','AdminControllers\AdminControllersSub\NewTicketBookingController@index');
Route::get('/admin/new-admin','AdminControllers\AdminControllersSub\UserController@create');

//page untuk update data super admin
Route::get('/admin/updatemuseum','AdminControllers\AdminControllersSub\NewMuseumController@edit');
Route::get('/admin/updateevent','AdminControllers\AdminControllersSub\NewEventController@edit');
Route::get('/admin/updatecollection','AdminControllers\AdminControllersSub\NewCollectionController@edit');
Route::get('/admin/updateschedule','AdminControllers\AdminControllersSub\NewScheduleController@edit');
Route::get('/admin/updateticket','AdminControllers\adminControllersSub\NewTicketController@edit');
Route::get('/admin/updatebooking','AdminControllers\AdminControllersSub\NewTicketBookingController@edit');
Route::get('/admin/edit-admin','AdminControllers\AdminControllersSub\UserController@edit');

//page untuk delete data super admin
Route::get('/admin/deletecollection','AdminControllers\AdminControllersSub\NewCollectionController@show');
Route::get('/admin/deleteschedule','AdminControllers\AdminControllersSub\NewScheduleController@show');
Route::get('/admin/deleteticket','AdminControllers\adminControllersSub\newTicketController@show');
Route::get('/admin/delete-admin','AdminControllers\adminControllersSub\UserController@showDelete');
Route::get('/admin/delete-booking','AdminControllers\AdminControllersSub\NewTicketBookingController@showDelete');

//post untuk simpan data baru super admin
Route::post('/admin/newmuseumupload','AdminControllers\AdminControllersSub\NewMuseumController@savemuseum');
Route::post('/admin/neweventupload', 'AdminControllers\AdminControllersSub\NewEventController@saveevent');
Route::post('/admin/newcollectionupload', 'AdminControllers\AdminControllersSub\NewCollectionController@savecollection');
Route::post('/admin/newscheduleupload','AdminControllers\AdminControllersSub\NewScheduleController@saveschedule');
Route::post('/admin/newticketupload','AdminControllers\AdminControllersSub\NewTicketController@saveticket');
Route::post('/admin/new-admin','AdminControllers\AdminControllersSub\UserController@store');

//post untuk update data superadmin
Route::post('/admin/updatemuseum','AdminControllers\AdminControllersSub\NewMuseumController@update');
Route::post('/admin/updateevent','AdminControllers\AdminControllersSub\NewEventController@update');
Route::post('/admin/updatecollection','AdminControllers\AdminControllersSub\NewCollectionController@update');
Route::post('/admin/updateschedule','AdminControllers\AdminControllersSub\NewScheduleController@update');
Route::post('/admin/updateticket','AdminControllers\AdminControllersSub\NewTicketController@update');
Route::post('/admin/update-admin','AdminControllers\AdminControllersSub\UserController@update');

//post untuk delete data super admin
Route::post('/admin/deletecollection','AdminControllers\AdminControllersSub\NewCollectionController@destroy');
Route::post('/admin/deleteschedule','AdminControllers\AdminControllersSub\NewScheduleController@destroy');
Route::post('/admin/deleteticket','AdminControllers\adminControllersSub\newTicketController@destroy');
Route::post('/admin/delete-admin','AdminControllers\adminControllersSub\UserController@destroy');
Route::post('/admin/delete-booking','AdminControllers\adminControllersSub\NewTicketBookingController@destroy');





/*-----*****guest starter page*****-----
----------------------------------------
----------------------------------------
--------------------------------------*/

//search
Route::get('/{namamuseum}/search', 'SearchController@index');
//event
Route::get('/{namamuseum}/events', 'MuseumControllers\EventController@index');
//subeventdetail
Route::get('/{namamuseum}/events/{event}', 'MuseumControllers\EventController@subindex');

//collection
Route::get('/{namamuseum}/collections', 'MuseumControllers\CollectionController@index');
//subcollection
Route::get('/{namamuseum}/collections/{collection}','MuseumControllers\CollectionController@subindex');

//information
Route::get('/{namamuseum}/information', 'MuseumControllers\InformationController@index');

//get AJAX request
Route::get('/ajax-request/get-event-by-museum', 'AdminControllers\AdminControllersSub\NewEventController@getEvent');
Route::get('/ajax-request/get-collection-by-museum', 'AdminControllers\AdminControllersSub\NewCollectionController@getCollection');
Route::get('/ajax-request/get-image-by-collection', 'AdminControllers\AdminControllersSub\NewCollectionController@getImage');
Route::get('/ajax-request/get-schedule-by-museum', 'AdminControllers\AdminControllersSub\NewScheduleController@getSchedule');
Route::get('/ajax-request/get-ticket-by-schedule', 'AdminControllers\AdminControllersSub\NewTicketController@getTicket');
Route::post('/ajax-request/get-user', 'AdminControllers\AdminControllersSub\UserController@show');
//email
Route::post('/guest/send-email','emailController@index');

//fix
Route::get('/ajax-request-only/get-schedule-by-museum', 'AjaxControllers\AjaxScheduleController@getSchedule');
/*blade pengguna
1.welcome.blade.php
*/
Route::get('/ajax-request-only/get-ticket-by-schedule','AjaxControllers\AjaxTicketController@getTicket');
/*blade pengguna
1.welcome.blade.php
*/

/*
Route::post('/testing/email','emailController@test');
*/


