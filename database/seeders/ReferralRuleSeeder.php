<?php

namespace Database\Seeders;

use App\Enums\ReferralRuleType;
use App\Models\ReferralRule;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Application;

class ReferralRuleSeeder extends Seeder
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
     * Creating a set of referral-rules that will be available after installing
     * the system in a production environment.
     *
     * @return void
     */
    private function createForProduction(): void
    {
        ReferralRule::create([
            'name' => 'Fixed',
            'type' => ReferralRuleType::Fixed,
            'interest' => 30.0,
        ]);

        ReferralRule::create([
            'name' => 'Percentage',
            'type' => ReferralRuleType::Percentage,
            'interest' => 3.0,
        ]);
    }

    /**
     * Create a set of referral-rules for testing purposes.
     *
     * @return void
     */
    private function createForTesting(): void
    {
        ReferralRule::factory(2)->fixed()->create();
        ReferralRule::factory(2)->percentage()->create();
    }
}
