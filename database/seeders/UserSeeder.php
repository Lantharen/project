<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Application;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param  \Illuminate\Foundation\Application  $application
     * @return void
     */
    public function run(Application $application): void
    {
        if ($application->isProduction()) {
            // Don't create users for the production environment
            return;
        }

        User::factory(10)->create();
    }
}
