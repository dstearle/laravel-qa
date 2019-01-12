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
        //Generates three random users
        factory(App\User::class, 3)->create()->each( function($u) {

            $u->questions()
            ->saveMany(
                //Gerenates from one to five random questions for each user
                factory(App\Question::class, rand(1, 5))->make()
            )
            //Generates from one to five answers for each question
            ->each(function($q) {

                $q->answers()->saveMany(factory(App\Answer::class, rand(1, 5))->make());
                
            });

        });
    }
}
