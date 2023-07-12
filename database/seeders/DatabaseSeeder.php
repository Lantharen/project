<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\HttpLog;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Application;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(Application $application): void
    {
        $this->callOnce(OfferSeeder::class);
        $this->callOnce(UserSeeder::class);
        $this->callOnce(ReferralRuleSeeder::class);
        $this->callOnce(ReferralSeeder::class);

        if (!$application->isProduction()) {
            HttpLog::factory(1000)->create();
        }
    }
}
