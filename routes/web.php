<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\MessageController;
use Illuminate\Support\Facades\Log;

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
    return Inertia::render('Home', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});


Route::middleware(['auth'])->group(function () {
    Route::get('/chat', [ChatController::class, 'index'])->name('chat');
});




Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';


// Route::get('/chat', [ChatController::class, 'index']);
// Route::post('/chat/send', [ChatController::class, 'sendMessage']);

// Route::post('/send-message', [ChatController::class, 'sendMessage'])->name('send-message');
// Route::get('/send-message', [ChatController::class, 'sendMessage'])->name('send-message');

// use OpenAI\Laravel\Facades\OpenAI;

// Route::post('/chat', function () {
//     try {
//         $result = OpenAI::completions()->create([
//             'model' => 'text-davinci-003',
//             'prompt' => 'PHP is',
//         ]);

//         echo $result['choices'][0]['text'];
//     } catch (Exception $e) {
//         // Log the error and capture additional details
//         Log::error('Error while processing OpenAI request: ' . $e->getMessage());
//         Log::error('Trace: ' . $e->getTraceAsString());
//         echo "An error occurred while processing the request.";
//     }
// });





Route::post('/send-message', [ChatController::class, 'sendMessage'])->name('send-message');
Route::get('/message-history', [MessageController::class, 'store'])->name('get-message-history');
Route::get('/message-history', [MessageController::class, 'index'])->name('get-message-history');
// routes/web.php

Route::get('/chat', 'ChatController@index')->name('chat'); // Define a rota do chat
