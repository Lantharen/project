<?php

namespace App\Actions;

use App\Contracts\Actionable;
use App\Models\Referral;

class DeleteReferral implements Actionable
{
    /**
     * The referral whose deleting
     *
     * @var \App\Models\Referral
     */
    private readonly Referral $referral;

    /**
     * DeleteReferral constructor.
     *
     * @param  \App\Models\Referral $referral
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
        $this->referral->delete();
    }
}
