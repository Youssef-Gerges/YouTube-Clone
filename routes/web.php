<?php

use App\Http\Controllers\ChannelController;
use App\Http\Controllers\searchController;
use App\Http\Livewire\Channel\EditChannel;
use App\Http\Livewire\Video\Create;
use App\Http\Livewire\Video\Edit;
use App\Http\Livewire\Video\Index;
use App\Http\Livewire\Video\Show;
use App\Models\Channel;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    if (Auth::check()) {
        $channels = auth()->user()->subscribedChannels()->with('videos')->get()->pluck('videos');
    } else {
        $channels = Channel::get()->pluck('videos');
    }
    // dd($channels);
    return view('welcome', compact('channels'));
});

Route::get('search', [searchController::class, 'search'])->name('search');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('videos/{channel}', Index::class)->name('video.all');
Route::middleware('auth')->group(function () {
    Route::get('channel/{channel}/edit', EditChannel::class)->name('channel.edit');

    //Videos Routes
    Route::get('videos/{channel}/create', Create::class)->name('video.create');
    Route::get('videos/{channel}/{video}/edit', Edit::class)->name('video.edit');
});
Route::get('videos/{channel}/{video}', Show::class)->name('video.show');
Route::get('channels/{channel}', [ChannelController::class, 'index'])->name('channel.index');

require __DIR__ . '/auth.php';
