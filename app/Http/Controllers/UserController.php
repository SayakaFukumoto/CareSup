<?php
namespace App\Http\Controllers;

use Session;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Customer;
use App\Models\CareRecord;
use App\Models\User;

//↓バリデーションの関係の処理のやつ
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

class UserController extends Controller
{
  private $customer;

  public function __construct(){
    $this -> User = new User();
    $this -> CareRecord = new CareRecord();
    //$this->middleware('auth');

  }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
      return view('top');
    }



  //$validatedData = $request->validate([
    //'login_id' => 'required|max:30',
    //'old_password' => 'required|confirmed|max:30',
    //'new_password' => 'required|max:30',
    //'new_password_confirmation' => 'required|max:30',
  //]);

  public function userLogin(Request $request){
    $validatedData = $request->validate([
      'login_id' => 'required|max:30',
      'password' => 'required|max:30',
    ]);

    $userDeta=$this->User->findUserByID($request);

    if(empty($userDeta -> password)){
      $loginUserError=1;
      return view('login',compact('loginUserError'));
    }

    if(password_verify($request['password'],$userDeta -> password)){

      session(['user_id' => $userDeta['id']]);
      session(['user' => $userDeta['name']]);
      session(['role_id' => $userDeta['role_id']]);

      $news= $this -> CareRecord ->findAllNews();
      $sharedMatters= $this -> CareRecord ->findRecords(1,4,'share');
      $nursingRecords= $this -> CareRecord ->findRecords(2,5,'nurse');
      $careRecords= $this -> CareRecord ->findRecords(3,5,'care');
      return view('top',compact('news','sharedMatters','nursingRecords','careRecords'));
    }else{
      $loginPasswordError=1;
      return view('login',compact('loginPasswordError'));
    }
  }

  public function updatePassword(Request $request){

    $validatedData = $request->validate([
      'login_id' => 'required|max:30',
      'old_password' => 'required|max:30',
      'password' => 'required|max:30',
      'password_confirmation' => 'required|max:30',
    ]);

    $userDeta=$this->User->findUserByID($request);

    if(empty($userDeta -> password)){
      $loginUserError=1;
      return view('login',compact('loginUserError'));
    }


    if(password_verify($request['old_password'],$userDeta -> password)&&$request['password']==$request['password_confirmation']){

      $records=$this->User->updatePassword($request);

      return view('pass_update_comp');
    }else{
      $loginPasswordError=1;
      return view('pass_update',compact('loginPasswordError'));
    }
  }



  public function userLogout(){
    session()->flush();
    return view('logout');
  }

}
