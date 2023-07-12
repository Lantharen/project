<?php

namespace App\Actions;

use App\Contracts\Actionable;
use App\Models\Referral;

class SaveReferral implements Actionable
{
    /**
     * The Referral whose create or update.
     *
     * @var \App\Models\Referral $referral
     */
    private readonly Referral $referral;

    /**
     * Create a new action instance.
     *
     * @param Referral $referral
     */
    public function __construct(Referral $referral)
    {
        $this->referral = $referral;
    }

    /**
     * {@inheritDoc}
     */
    public function execute(): void
    {
        $this->referral->save();
    }
}
