<?php

use App\Http\Controllers\ProductController;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::resource('products', ProductController::class);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/prueba', function(){
/* 
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://127.0.0.1:8000/api/tasks',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
));
 */
$client = new Client();
$options = [
  'multipart' => [
    [
      'name' => 'title',
      'contents' => 'PEDIDOD #7889689'
    ],
    [
      'name' => 'description',
      'contents' => 'PANCHO CON PONCHO'
    ]
]];
$request = new Request('GET', 'http://127.0.0.1:8000/api/tasks');
$tareas = $client->sendAsync($request, $options)->wait();
echo $tareas->getBody();


/* curl_close($curl);
 */
    return view('algo')->with('tareas',$tareas->getBody());

});