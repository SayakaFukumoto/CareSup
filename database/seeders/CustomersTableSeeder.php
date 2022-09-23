<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;//追加
use App\Models\Customer;

class CustomersTableSeeder extends Seeder
{
  /**
  * Run the database seeds.
  *
  * @return void
  */
  public function run()
  {
    DB::table('customers')->truncate();
    $testCustomers=[
      [ 'name'=>'木村すばる',
      'room_number'=>'201',
      'image_url'=>'.\img\animal_smile_neko.png',
      'gender'=>'0',
      'birth'=>'1950/12/22',
      'medical_history'=>'既往歴なし',
      'personality'=>'元看護師',
      'state'=>'1'
      ],
      [ 'name'=>'石谷はるき',
      'room_number'=>'202',
      'image_url'=>'.\img\baby_cat.png',
      'gender'=>'0',
      'birth'=>'1992/01/14',
      'medical_history'=>'既往歴なし',
      'personality'=>'元声優',
      'state'=>'1'
      ],
      [ 'name'=>'天崎ひろこ',
      'room_number'=>'203',
      'image_url'=>'.\img\pet_fat_cat.png',
      'gender'=>'1',
      'birth'=>'1990/10/22',
      'medical_history'=>'既往歴なし',
      'personality'=>'元看護師',
      'state'=>'1'
    ],
      [ 'name'=>'鈴木たく',
      'room_number'=>'301',
      'image_url'=>'.\img\pet_cat_oddeye.png',
      'gender'=>'0',
      'birth'=>'1996/10/16',
      'medical_history'=>'既往歴なし',
      'personality'=>'元調理師',
      'state'=>'1'
    ],
    [ 'name'=>'犬',
    'room_number'=>'302',
    'image_url'=>'.\img\animal_smile_inu.png',
    'gender'=>'0',
    'birth'=>'1996/10/16',
    'medical_history'=>'既往歴なし',
    'personality'=>'元調理師',
    'state'=>'1'
    ],
      [ 'name'=>'猫',
      'room_number'=>'303',
      'image_url'=>'.\img\neko2.jpg',
      'gender'=>'1',
      'birth'=>'2022/08/16',
      'medical_history'=>'既往歴なし',
      'personality'=>'夜行性です。こまめにブラッシングをしてあげてください。',
      'state'=>'1'
      ]
    ];
    DB::table('customers')->insert($testCustomers);
  }
}
