<?php

use Illuminate\Database\Seeder;

class Roles extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (\App\Models\Roles\Role::ROLES as $role) {
            App\Models\Roles\Role::create([
                'name' => $role
            ]);
        }
    }
}
