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
Route::get('/test', function () {
    Log::error(__FUNCTION__);
    //magic function line to return current pphp line to debug and know at which line the code stopped
    Log::error(__LINE__);
    $fields = [
        'test' => 'ds',
        'user_id' => '1',
        'message' => 'hello 22'
    ];
    $url = 'localhost:3000/notifyNewOrder';
    $ch = curl_init();

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

    $fields_string = http_build_query($fields);

    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $result = curl_exec($ch);
    if ($result) {
        $result = json_decode($result);
        return $result;
    } else {
        return false;
    }
});
Route::get('/', function () {
    return view('welcome');
});
Route::get('/test   ', function () {
    return view('emails.order-email');
});
Route::get('/php', function () {
    return phpinfo();
});

Route::get('/vendor', function () {
    return view('vendor.dashboard.index');
});
Route::group(['prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']],
    function () {
        Auth::routes();

        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    });
