<?php

namespace App\Actions;


use App\Contracts\Actionable;
use App\Models\Offer;

class SaveOffer implements Actionable
{
    /**
     * The offer whose create or update.
     */
    private readonly Offer $offer;

    /**
     * Create a new action instance.
     *
     * @param $offer
     */
    public function __construct($offer)
    {
        $this->offer = $offer;
    }

    /**
     * {@inheritDoc}
     */
    public function execute(): void
    {
        $this->offer->save();
    }
}
