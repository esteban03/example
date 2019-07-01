<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            RolsTableSeeder::class,
            EvaluationTableSeed::class,
            EvaluationUsersTableSeed::class,
            QuestionsTableSeed::class,
            QuestionsTableSeed::class,
            ResponseUsersTableSeed::class,
            CategoryQuestionsTableSeed::class
        ]);
    }
}
