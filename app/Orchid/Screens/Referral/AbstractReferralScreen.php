<?php

namespace App\Orchid\Screens\Referral;

use App\Actions\DeleteReferral;
use App\Models\Referral;
use Exception;
use Illuminate\Http\RedirectResponse;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;

abstract class AbstractReferralScreen extends Screen
{
    /**
     * Delete the given transaction.
     *
     * @param  \App\Models\Referral $referral
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteReferral(Referral $referral): RedirectResponse
    {
        try {
            (new DeleteReferral($referral))->execute();
            Toast::warning(__('Referral was removed'));
        } catch (Exception $exception) {
            Toast::error(__($exception->getMessage()));
        }

        return redirect()->route('platform.systems.referrals');
    }
}
