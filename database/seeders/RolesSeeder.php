<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;//追加
use App\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('roles')->truncate();
      $roles=[
        [ 'id'=>1,
          'name'=>'ホーム長'],
        [ 'id'=>2,
          'name'=>'運営'],
        [ 'id'=>3,
          'name'=>'看護師'],
        [ 'id'=>4,
          'name'=>'職員'],
      ];

      DB::table('roles')->insert($roles);
    }
}
