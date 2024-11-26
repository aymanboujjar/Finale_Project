<?php

namespace Database\Seeders;

use App\Models\Projectfinale;
use Illuminate\Database\Seeder;

class FinalprojectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insert multiple records using the `insert` method
        Projectfinale::insert([
            [
                "question" => "What is the correct syntax to declare a variable in PHP?",
                "reponse" => "$ variable"
            ],
            [
                "question" => "Which of the following is used to comment in PHP?",
                "reponse" => "// or /* */"
            ],
            [
                "question" => "What function is used to include a file in PHP?",
                "reponse" => "include()"
            ],
        ]);
        
    }
}
