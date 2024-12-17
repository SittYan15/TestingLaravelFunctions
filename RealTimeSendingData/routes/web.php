<?php

use App\Events\MyEvent;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/noti', function () {

    $options = array(
        'cluster' => 'ap1',
        'useTLS' => true
      );


    $pusher = new Pusher\Pusher(
        env('PUSHER_APP_KEY'),
        env('PUSHER_APP_SECRET'),
        env('PUSHER_APP_ID'),
        $options
    );

    $data['message'] = 'hello world';

    $pusher->trigger('my-channel', 'my-event', $data);

    return redirect()->back();
})->name('make-noti');
