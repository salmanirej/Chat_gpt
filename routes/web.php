<?php
use Illuminate\Http\Request;
use App\Events\NewMessage;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\MessagesController;
use App\Http\Controllers\Room_userController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Event;
 
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::post('/send-message', function (Request $request) {
//     $message = $request->input('message');

//     event(new NewMessage($message));
// });
//Route::post('/savemessage', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Route::resource('rooms', RoomController::class);
 
//Route::resource('messages', MessagesController::class );
 
Route::post('/mypage', function ( Request $request) {
    $message = $request->input('message');
    Event::dispatch(new NewMessage($request));
  //  return view('my-page');
});
Route::post('/example', function (Request $request) {
    $data = $request->input('data');
    // تنفيذ المعالجة هنا باستخدام $data
    return response()->json(['success' => true]);
});

use Symfony\Component\HttpFoundation\StreamedResponse;

Route::get('/openai', function () {
    return new StreamedResponse(function () {
        while (true) {
            // إنشاء اتصال server-sent events
            echo "event: message\n";
            echo "data: Hello, world!\n\n";
            ob_flush();
            flush();

            // تنفيذ العمليات المطلوبة على البيانات المستلمة هنا
            sleep(1);
        }
    });
});