<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;//追加
use App\Models\User;//追加

class UsersTableSeeder extends Seeder
{
  /**
  * Run the database seeds.
  *
  * @return void
  */
  public function run()
  {
    DB::table('users')->truncate();
    $date=date('Y-m-d H:i:s');

    //passwordは全員test123
    $test_users=[
      [ 'login_id'=>'test1',
      'name'=>'山田一郎(ホーム長)',
      'password'=>'$2y$10$dIor52ZrB8xuocqnOweBzOEEjMR/AjPU3DcFYYWUrOwSaoUmbgVda',
      'role_id'=>'1',
      'created_at'=>$date],
      [ 'login_id'=>'test2',
      'name'=>'山田二郎(運営)',
      'password'=>'$2y$10$dIor52ZrB8xuocqnOweBzOEEjMR/AjPU3DcFYYWUrOwSaoUmbgVda',
      'role_id'=>'2',
      'created_at'=>$date],
      [ 'login_id'=>'test3',
      'name'=>'山田三郎(看護職員)',
      'password'=>'$2y$10$dIor52ZrB8xuocqnOweBzOEEjMR/AjPU3DcFYYWUrOwSaoUmbgVda',
      'role_id'=>'3',
      'created_at'=>$date],
      [ 'login_id'=>'test4',
      'name'=>'山田零(介護職員)',
      'password'=>'$2y$10$dIor52ZrB8xuocqnOweBzOEEjMR/AjPU3DcFYYWUrOwSaoUmbgVda',
      'role_id'=>'4',
      'created_at'=>$date]
    ];
    DB::table('users')->insert($test_users);
  }
}
