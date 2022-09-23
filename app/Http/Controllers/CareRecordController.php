<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Customer;
use App\Models\CareRecord;
use App\Models\User;

//↓バリデーションの関係の処理のやつ
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

//Storeを使うためのやつ
use Illuminate\Support\Facades\Storage;

class CareRecordController extends Controller
{
  private $customer;

  public function __construct(){
    $this -> Customer = new Customer();
    $this -> CareRecord = new CareRecord();
    $this -> User = new User();
  }

  //TOP画面に表示する記録を抽出
  public function viewRecords(){
    $news= $this -> CareRecord ->findAllNews();
    $sharedMatters= $this -> CareRecord ->findRecords(1,4,'share');
    $nursingRecords= $this -> CareRecord ->findRecords(2,5,'nurse');
    $careRecords= $this -> CareRecord ->findRecords(3,5,'care');
    return view('top',compact('news','sharedMatters','nursingRecords','careRecords'));
  }

  //消してTOP画面に表示する記録を再抽出
  public function delete(Request $request){
    $id=$request['id'];
    $this ->CareRecord -> deleteNews($id);
    $news= $this -> CareRecord ->findAllNews();
    $sharedMatters= $this -> CareRecord ->findRecords(1,4,'share');
    $nursingRecords= $this -> CareRecord ->findRecords(2,5,'nurse');
    $careRecords= $this -> CareRecord ->findRecords(3,5,'care');
    return view('top',compact('news','sharedMatters','nursingRecords','careRecords'));
  }

  //お知らせの詳細表示用
  public function getNews(Request $request){
    $id=$request['id'];
    $news= $this -> CareRecord ->findNewsByID($id);
    return view('news',compact('news'));
  }

  //お知らせ編集画面の表示用
  public function getNewsForUpdate(Request $request){
    $id=$request['id'];
    $news= $this -> CareRecord ->findNewsByID($id);
    return view('news_update',compact('news'));
  }

  //お知らせ作成処理
  public function insertNews(Request $request){
    $validatedData = $request->validate([
      'user_id' => 'numeric',
      'title' => 'required|max:30',
      'detail' => 'required',
      'type' => 'required|numeric',
    ]);
    $records=$this->CareRecord->insertCareRecord($request);
    return view('news_insert_comp');
  }

  //お知らせの更新処理
  public function updateCareRecord(Request $request){
    $validatedData = $request->validate([
      'user_id' => 'numeric',
      'title' => 'required|max:30',
      'detail' => 'required',
      'type' => 'required|numeric',
    ]);
    $records=$this->CareRecord->updateCareRecord($request);
    return view('news_update_comp');
  }


  //入居者一覧抽出
  public function indexCustomer(){
    $customers= $this -> Customer ->getAllCustomers();
    return view('index',compact('customers'));
  }

  //入居者詳細抽出
  public function viewCustomer(Request $request){
    $id=$request['id'];
    $customer= $this -> Customer ->getCustomerById($id);
    $records= $this -> CareRecord ->findRecordsById($id);
    return view('view',compact('customer','records'));
  }

  //共有・介護・看護記録作画面のプルダウンするための処理
  public function recordInsertPage(){
    $customers= $this -> Customer ->getAllCustomers();
    return view('record_insert',compact('customers'));
  }

  //共有・介護・看護記録作成処理
  public function insertRecord(Request $request){
    $validatedData = $request->validate([
      'user_id' => 'numeric',
      'title' => 'nullable|max:30',
      'customer_id' => 'nullable|numeric',
      'detail' => 'required',
      'type' => 'required|numeric',
    ]);

    if($request['type']== (2||3) && $request['customer_id'] == 0){
      $detail=$request['detail'];
      $customers= $this -> Customer ->getAllCustomers();
      $typeError=1;
      return view('record_insert',compact('typeError','customers','detail'));
      exit;
    }

    $records=$this->CareRecord->insertCareRecord($request);
    return view('record_insert_comp');
  }



  //職員登録
  public function registerUser(Request $request){
    $validatedData = $request->validate([
      'login_id' => 'required|max:30',
      'name' => 'required|max:30',
      'password' => 'required|max:30',
      'role_id' => 'required|numeric',
      'password_confirmation' =>'required|max:30',
    ]);

    $countLoginId=$this->User->loginIdCheck($request);

    if($countLoginId == 0 &&$request['password']==$request['password_confirmation']){
      $records=$this->User->regist($request);
      return view('user_register_comp');
    }else{
      $loginIdError=1;
      return view('user_register',compact('loginIdError'));
    }
  }

  //入居者新規登録
  public function store(Request $request){
    $validatedData = $request->validate([
      'image_url' => 'nullable|max:800',
      'name' => 'required|max:30',
      'room_number' => 'nullable|numeric',
      'birth' => 'nullable|date',
      'medical_history' => 'nullable|max:200',
      'personality' => 'nullable|max:1000',
    ]);

    $path=null;
    if(!empty($request['image_url'])){
      $file_name = $request->file('image_url')->getClientOriginalName();
      $request->file('image_url')->storeAs('public/',$file_name);
      $path='storage/'.$file_name;
    }

    $records=$this->Customer->registerCustomer($request,$path);

    return view('customer_register_comp');
  }

  public function deleteCustomer(Request $request){
    $id=$request['id'];
    $this ->Customer -> deleteCustomer($id);
    $customers= $this -> Customer ->getAllCustomers();
    return view('index',compact('customers'));
  }

  //編集画面での入居者情報取得
  public function getDataForUpdate(Request $request){
    $id=$request['id'];
    $customer=$this ->Customer -> getCustomerById($id);
    return view('customer_update',compact('customer'));
  }

  //入居者編集
  public function updateCustomer(Request $request){

    $validatedData = $request->validate([
      'image_url' => 'nullable|max:800',
      'name' => 'required|max:30',
      'room_number' => 'nullable|numeric',
      'birth' => 'nullable|date',
      'medical_history' => 'nullable|max:200',
      'personality' => 'nullable|max:1000',
    ]);

    //もし画僧が選択されていた場合は先にこれだけ入れる。
    if(!empty($request['image_url'])){
      $file_name = $request->file('image_url')->getClientOriginalName();
      $request->file('image_url')->storeAs('public/',$file_name);
      $path='storage/'.$file_name;
      $image=$this->Customer->updateImage($request,$path);
    }

    $records=$this->Customer->updateCustomer($request);

    return view('customer_update_comp');
  }

}
