<?php

use Illuminate\Database\Seeder;
use App\CategoryQuestion;

class CategoryQuestionsTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i <= 2 ; $i++) {
            CategoryQuestion::create([
                'Title' => 'Category '.$i
            ]);
        }
    }
}
