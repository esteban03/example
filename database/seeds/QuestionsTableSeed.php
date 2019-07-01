<?php

use Illuminate\Database\Seeder;
use App\Question;

class QuestionsTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i <= 3; $i++) {
            Question::create([
                'evaluation_id' => 1,
                'category_id'  => 1,
                'question' => 'Lorem Ipsum is simply dummy text of the printing and typesetting'
            ]);
        }

        for ($i=1; $i <= 3; $i++) {
            Question::create([
                'evaluation_id' => 2,
                'category_id'  => 2,
                'question' => 'Lorem Ipsum is simply dummy text of the printing and typesetting'
            ]);
        }
    }
}
