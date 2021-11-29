<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group([
    'namespace' => 'Channel',
    'prefix'    => 'channels',
],
    function () {
        Route::get('/', 'ChannelController@index')
            ->name('api.channels.index')
            ->can('viewAny', \App\Models\Channel::class);

        Route::post('/', 'ChannelController@store')
            ->name('api.channels.store');

        Route::get('{channel}', 'ChannelController@show')
            ->name('api.channels.show')
            ->can('view', 'channel');

        Route::patch('{channel}', 'ChannelController@update')
            ->name('api.channels.update');

        Route::delete('{channel}', 'ChannelController@destroy')
            ->name('api.channels.destroy')
            ->can('delete', 'channel');

        Route::group([
            'namespace' => 'Message',
            'prefix'    => '{channel}/messages',
        ],
            function () {
                Route::get('/', 'MessageController@index')
                    ->name('api.channels.messages.index')
                    ->can('viewAny', \App\Models\Message::class);

                Route::post('/', 'MessageController@store')
                    ->name('api.channels.messages.store');
            });
    });
