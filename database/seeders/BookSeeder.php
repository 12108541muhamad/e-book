<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Book::create([
            'title' => 'Jomblo Narsis',
            'writer' => 'Dina Mardiana',
            'publisher' => 'GagasanMedia',
            'isbn' => '979',
            'synopsis' => 'Menyandang status jomblo ternyata membuat Jono merasa makin resah sehingga ia memutuskan untuk mengakhiri status tersebut secepatnya. Bersama Niko sahabatnya, Jono mulai melakukan berbagai upaya untuk mendapatkan pacar. Hingga suatu hari calon pacar potensial berhasil didapatkannya dari dunia maya.
                            Setelah berkenalan, Jono berharap bisa sampai ke tahap selanjutnya. Namun, sayangnya, rencana tidak berjalan mulus. Akankah Jono kembali harus menjalani status jomblonya? Atau mungkin akan muncul keajaiban kenalan tersebut menjadi pacar pertamanya?',
            'cover' => 'jomblonarisis.jpg',
            'category' => 'Comedy',
         ]);
    }
}
