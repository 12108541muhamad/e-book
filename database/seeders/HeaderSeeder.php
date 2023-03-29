<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Header;

class HeaderSeeder extends Seeder
{
   /**
    * Run the database seeds.
    *
    * @return void
    */
   public function run()
   {
      Header::create([
         'heading' => 'Better Solutions For Your Choice Book',
         'subheading' => 'Welcome to E-Book',
         'banner' => '1679633602.jpg'
      ]);
   }
}
