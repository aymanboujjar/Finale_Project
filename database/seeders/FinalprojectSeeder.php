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
                "question" => "hello",
                "reponse" => "hello"
            ],
            [
                "question" => "hello",
                "reponse" => "hello"
            ],
            [
                "question" => "hello",
                "reponse" => "hello"
            ],
        ]);
    }
}
