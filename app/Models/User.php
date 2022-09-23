<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//パスワードハッシュ
use Illuminate\Support\Facades\Hash;

class User extends Model
{
  use HasFactory;

  protected $fillable = [
      'login_id',
      'name',
      'password',
      'role_id',
  ];

  protected $hidden = [
      'password',
  ];


  public static function getParams($request){
    $date=date("Y-m-d H:i:s");
    $password= Hash::make($request['password']);
    $old_password= Hash::make($request['old_password']);
    $params=[
      'login_id' => $request['login_id'],
      'name' => $request['name'],
      'password' => $password,
      'role_id' => $request['role_id'],
      'created_at' => $date
    ];
    return $params;
  }

  //職員IDがすでに登録されていないかを調べる。
  //登録されている場合、１が返ってくる。
  public function loginIdCheck($request){
    $loginIdCheck= User:: where('login_id','=', $request['login_id']) ->count();
    return $loginIdCheck;
  }

  public function findUserByID($request){
    $loginPasswordCheck= User::where('login_id','=', $request['login_id']) ->first();
    return $loginPasswordCheck;
  }

  public function updatePassword($request){
    $date=date("Y-m-d H:i:s");
    $password= Hash::make($request['password']);
    $params=[
      'password' => $password,
      'updated_at' => $date
    ];
    $updete= User::where('login_id', $request['login_id']) -> update($params);
  }


  //職員登録
  public function regist($request){
    $params=self::getParams($request);
    $updete= User::insert($params);
  }


}
