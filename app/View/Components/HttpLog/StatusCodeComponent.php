<?php

namespace App\View\Components\HttpLog;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class StatusCodeComponent extends Component
{
    /**
     * The response code.
     *
     * @var int
     */
    public int $statusCode;

    /**
     * Create a new component instance.
     *
     * @param  int  $statusCode  The response code.
     * @return void
     */
    public function __construct(int $statusCode)
    {
        $this->statusCode = $statusCode;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|Closure|string
     */
    public function render(): View|Closure|string
    {
        return view('components.http-log.status-code');
    }

    /**
     * Get the color class for the response code.
     *
     * @return string
     */
    public function colorClass(): string
    {
        if ($this->statusCode >= 500) {
            return 'text-danger';
        }

        if ($this->statusCode >= 400) {
            return 'text-warning';
        }

        if ($this->statusCode >= 300) {
            return 'text-primary';
        }

        if ($this->statusCode >= 200) {
            return 'text-success';
        }

        return 'text-info';
    }
}
