<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Customer extends Model
{
  use HasFactory;

  protected $fillable = [
    'name',
    'image_url',
  ];

  public function getAllCustomers(){
    $customers= Customer::select()
    -> orderByRaw('room_number IS NULL ASC')
    -> orderBy('room_number')
    -> get();
    return $customers;
  }

  public function getCustomerById($id){
    $customer= Customer::select()
    ->where('id','=',$id)-> get();
    return $customer[0];
  }

  public static function getParams($request,$path){
    $date=date("Y-m-d H:i:s");
    $params=[
      'image_url' => $path,
      'name' => $request['name'],
      'state' => $request['state'],
      'room_number' => $request['room_number'],
      'gender' => $request['gender'],
      'birth' => $request['birth'],
      'medical_history' => $request['medical_history'],
      'personality' => $request['personality'],
      'created_at' => $date
    ];
    return $params;
  }

  public function registerCustomer($request,$path){
    $params=self::getParams($request,$path);
    $updete= Customer::insert($params);
  }

  public function updateCustomer($request){
    $id=$request['id'];
    $date=date("Y-m-d H:i:s");
    $params=[
      'name' => $request['name'],
      'state' => $request['state'],
      'room_number' => $request['room_number'],
      'gender' => $request['gender'],
      'birth' => $request['birth'],
      'medical_history' => $request['medical_history'],
      'personality' => $request['personality'],
      'created_at' => $date
    ];
    $updete= Customer::where('id',$id)->update($params);
  }

  public function updateImage($request,$path){
    $id=$request['id'];
    $params=[
      'image_url' => $path
    ];
    $updete= Customer::where('id',$id)->update($params);
  }

  public function deleteCustomer($id){
    Customer::where('id',$id)->delete();
  }
}
