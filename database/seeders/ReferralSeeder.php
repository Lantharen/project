<?php

namespace Database\Seeders;

use App\Models\Referral;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Application;

class ReferralSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Application $application): void
    {
        if ($application->isProduction()) {
            // Don't create users for the production environment
            return;
        }

        $referrers = User::inRandomOrder()
            ->limit(3)
            ->pluck('id');

        $referrals = User::inRandomOrder()
            ->limit(3)
            ->whereNotIn('id', $referrers)
            ->pluck('id');

        Referral::factory(1)->pending()->create([
            'referrer_id' => $referrers[0],
            'referral_id' => $referrals[0],
        ]);

        Referral::factory(1)->approved()->create([
            'referrer_id' => $referrers[1],
            'referral_id' => $referrals[1],
        ]);

        Referral::factory(1)->rejected()->create([
            'referrer_id' => $referrers[2],
            'referral_id' => $referrals[2],
        ]);
    }
}
