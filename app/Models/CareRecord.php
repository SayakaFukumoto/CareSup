<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;

class CareRecord extends Model
{
  use HasFactory;

  public static function getParams($request){
  $date=date("Y-m-d H:i:s");
  $params=[
    'user_id' => $request['user_id'],
    'title' => $request['title'],
    'customer_id' => $request['customer_id'],
    'detail' => $request['detail'],
    'type' => $request['type'],
    'created_at' => $date
  ];
  return $params;
}

  public function findAllNews(){
    $news= CareRecord::select(['care_records.id','care_records.created_at', 'users.name','title'])
    -> from ('care_records')
    ->join ('users',function($join){$join ->on('care_records.user_id','=','users.id');})
    -> where ('type','=',0)
    -> orderBy('care_records.created_at','DESC')
    ->paginate( $perPage = 4, $columns = ['*'], $pageName = 'news');
    return $news;
  }

  public function deleteNews($id){
    DB::table('care_records')->where('id',$id)->delete();
  }

//記録類の更新
  public function updateCareRecord($request){
    $id=$request['id'];
    $params=self::getParams($request);
    $updete= DB::table('care_records')->where('id',$id)->update($params);
    return $updete;
  }

//記録類の作成
  public function insertCareRecord($request){
    $params=self::getParams($request);
    $updete= DB::table('care_records')->insert($params);
  }



  public function findNewsByID($id){
    $param=['id'=>$id];
    $news = DB::select('SELECT care_records.id,care_records.created_at, users.name, title,detail from care_records join users on care_records.user_id = users.id where care_records.id = :id',$param);
    return $news[0];
  }

  public function findRecords($type_id,$page_count,$page_name){
    $sharedMatters = CareRecord::select(['care_records.id','care_records.created_at','customers.name as customer','customer_id','users.name','detail'])
    -> from ('care_records')
    ->leftjoin ('users',function($join){$join ->on('care_records.user_id','=','users.id');})
    ->leftjoin ('customers',function($join){$join ->on('care_records.customer_id','=','customers.id');})
    -> where ('type','=',$type_id)
    ->orderBy('care_records.created_at','DESC')
    ->paginate( $perPage = $page_count, $columns = ['*'], $pageName = $page_name);
    return $sharedMatters;
  }

  public function findRecordsById($id){
    $customerRecords = CareRecord::select(['care_records.id','care_records.created_at','customers.name as customer','users.name','detail','type'])
    -> from ('care_records')
    ->leftjoin ('users',function($join){$join ->on('care_records.user_id','=','users.id');})
    ->leftjoin ('customers',function($join){$join ->on('care_records.customer_id','=','customers.id');})
    -> where ('customers.id','=',$id)
    ->orderBy('care_records.created_at','DESC')
    ->paginate( $perPage = 20, $columns = ['*'], $pageName = 'page');
    return $customerRecords;
  }





}
