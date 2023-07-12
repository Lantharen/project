<?php

namespace App\Contracts;

use Orchid\Support\Presenter;

interface Presentable
{
    /**
     * Returns the model's presenter instance.
     *
     * @return \Orchid\Support\Presenter<$this>
     */
    public function presenter(): Presenter;

    /**
     * Returns a new instance of the model's presenter.
     *
     * @return \Orchid\Support\Presenter<$this>
     */
    public function newPresenter(): Presenter;
}
