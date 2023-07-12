<?php

namespace App\Orchid\Presenters;

use Orchid\Support\Presenter;

class OfferPresenter extends Presenter
{
    /**
     * Get the offer name.
     *
     * @return string
     */
    public function name(): string
    {
        return $this->entity->name;
    }

    /**
     * Get the offer investments line.
     *
     * @return string
     */
    public function investmentsLine(): string
    {
        $min = money_parse($this->entity->min_investment)->format();

        if (!$this->entity->max_investment) {
            // Ok, we got a fixed investments amount
            return $min;
        }

        $max = money_parse($this->entity->max_investment)->format();

        return "$min .. $max";
    }

    /**
     * Get the offer interests line.
     *
     * @return string
     */
    public function interestsLine(): string
    {
        $min = number_format($this->entity->min_interest, 2);

        if (!$this->entity->max_interest) {
            // Ok, we got a fixed interest amount
            return $min.'%';
        }

        $max = number_format($this->entity->max_interest, 2);

        return "$min% .. $max%";
    }

    /**
     * Get the offer duration in hours.
     *
     * @return string
     */
    public function durationInHours(): string
    {
        $hours = $this->entity->duration_in_seconds / 3600;

        return number_format($hours, 2, '.', '&nbsp;');
    }
}
