<?php

use Illuminate\Database\Seeder;

class Users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Added author
        factory(App\Models\User::class, 2)->create()->each(function ($user) {
            $user->posts()->save(factory(App\Models\Post::class)->make());
            $user->addRole(\App\Models\Roles\Role::AUTHOR);
        });

        //Added moderator
        factory(App\Models\User::class, 1)->create()->each(function ($user) {
            $user->addRole(\App\Models\Roles\Role::MODERATOR);
        });
    }
}
