<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Htt6p\Controllers\HomeController;
use App\Http\Controllers\CareRecordController;
use App\Http\Controllers\PDFController;

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

//ログイン画面
//Route::group(['middleware' => 'guest'],function(){
  Route::get('/',function () {return view('login');});
  Route::get('/login', function () {return view('login');})->name('login');

  Route::get('/pass_update', function () {return view('pass_update');});
  Route::post('/pass_update_comp', [UserController::class,'updatePassword']);

  Route::get('/logout', [UserController::class,'userLogout']);
  Route::post('/top',[UserController::class,'userLogin']);

//});

//->name('login')にredirectする。
//Route::group(['middleware' => 'auth'],function(){
  //ログイン後
  //全ユーザー使用可能機能
//Route::group(['middleware' => ['auth', 'can:all']], function () {
  Route::get('/top',[CareRecordController::class,'viewRecords'])->name('top');

  Route::get('/news', [CareRecordController::class,'getNews'])->name('news');

  Route::get('/record_insert',[CareRecordController::class,'recordInsertPage']);
  Route::post('/record_insert_comp',[CareRecordController::class,'insertRecord']);
  Route::get('/delete',[CareRecordController::class,'delete'])->name('delete');

  Route::get('/index', [CareRecordController::class,'indexCustomer']);
  Route::get('/customer_delete',[CareRecordController::class,'deleteCustomer'])->name('customer_delete');
  Route::get('/customer_update',[CareRecordController::class,'getDataForUpdate'])->name('customer_update');
  Route::post('/customer_update_comp',[CareRecordController::class,'updateCustomer']);

  Route::get('/view', [CareRecordController::class,'viewCustomer'])->name('view');
  Route::get('/pdf',[PDFController::class,'index'])->name('pdf');
//});




  Route::get('/news_update',[CareRecordController::class,'getNewsForUpdate'])->name('news_update');
  Route::post('/news_update_comp',[CareRecordController::class,'updateCareRecord']);

  Route::get('/news_insert',function () {return view('news_insert');});
  Route::post('/news_insert_comp',[CareRecordController::class,'insertNews']);

  Route::get('/customer_register', function () {return view('customer_register');});
  Route::post('/customer_register', function () {return view('customer_register');});
  Route::get('/customer_register_comp',[CareRecordController::class,'store']);
  Route::post('/customer_register_comp',[CareRecordController::class,'store'])->name('customer_register_comp');


  Route::get('/user_register', function () {return view('user_register');});
  Route::post('/user_register_comp',[CareRecordController::class,'registerUser']);


//});
