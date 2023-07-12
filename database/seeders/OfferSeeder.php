<?php

namespace Database\Seeders;

use App\Models\Offer;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Application;

class OfferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Application $application): void
    {
        if ($application->isProduction()) {
            $this->createForProduction();
        } else {
            $this->createForTesting();
        }
    }

    /**
     * Creating a set of offers that will be available after installing
     * the system in a production environment.
     *
     * @return void
     */
    private function createForProduction(): void
    {
        Offer::create([
            'name' => 'Simple',
            'min_investment' => 100.00,
            'max_investment' => 999.00,
            'min_interest' => 2.00,
            'max_interest' => 7.00,
            'duration_in_seconds' => 48 * 3600, // 2 days
            'position' => 10,
        ]);

        Offer::create([
            'name' => 'Advanced',
            'min_investment' => 1000.00,
            'max_investment' => 99999.00,
            'min_interest' => 5.00,
            'max_interest' => 15.00,
            'duration_in_seconds' => 72 * 3600, // 3 days
            'position' => 20,
        ]);

        Offer::create([
            'name' => 'Imperial',
            'min_investment' => 100000.00,
            'min_interest' => 25.00,
            'duration_in_seconds' => 72 * 3600, // 3 days
            'position' => 30,
        ]);
    }

    /**
     * Create a set of offers for testing purposes.
     *
     * @return void
     */
    private function createForTesting(): void
    {
        Offer::factory(2)->create();
        Offer::factory(1)->fixedInvestment()->create();
        Offer::factory(1)->fixedInterest()->create();
        Offer::factory(1)->fixedInvestment()->fixedInterest()->create();
    }
}
