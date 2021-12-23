<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use phpDocumentor\Reflection\Types\Integer;
use Illuminate\Support\Str;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('teachers')->insert([
            'name' => Str::random(10),
            'email' => Str::random(10).'@gmail.com',
            'subject' => Str::random(10),      
        ]);
    }
}
