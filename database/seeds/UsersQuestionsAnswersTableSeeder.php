<?php

use Illuminate\Database\Seeder;

class UsersQuestionsAnswersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('answers')->delete();
        \DB::table('questions')->delete();
        \DB::table('users')->delete();

        //Generates three random users
        factory(App\User::class, 3)->create()->each( function($u) {

            $u->questions()
            ->saveMany(
                //Gerenates from one to five random questions for each user
                factory(App\Question::class, rand(1, 5))->make()
            )
            //Generates from one to five answers for each question
            ->each(function ($q) {

                $q->answers()->saveMany(factory(App\Answer::class, rand(1, 5))->make());
                
            });

        });
    }
}
