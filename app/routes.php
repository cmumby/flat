<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('home');
});

Route::get('/feeds', 'FeedController@showFeedsInterface');
Route::get('/feeds/api/{type}/get/{id}', 'FeedController@getFeed');
Route::post('feeds/api/{type}/save/{id}', 'FeedController@saveFeed');
Route::post('feeds/api/managed/item/delete', 'FeedController@deleteItem');

Route::get('rss/{id}', 'FeedController@ShowFeed');

Route::get('admin', 'AdminController@showAdminInterface');
Route::get('admin/sources', 'AdminController@showSources');
Route::get('admin/sources/edit/{id}', 'AdminController@editSource');
Route::get('admin/sources/create', 'AdminController@createSource');
Route::get('admin/managed', 'AdminController@showManagedFeeds');
Route::get('admin/managed/edit/{id}', 'AdminController@editManagedFeed');
Route::get('admin/{type}/delete/{id}', 'AdminController@deletePrompt');
Route::post('admin/delete/confirm', 'FeedController@deleteFeed');
