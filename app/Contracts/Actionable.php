<?php

namespace App\Contracts;

interface Actionable
{
    /**
     * Handle the action request.
     *
     * @return mixed
     */
    public function execute();
}
