<?php

namespace App\View\Components\HttpLog;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class RequestMethodComponent extends Component
{
    /**
     * The request method.
     *
     * @var string
     */
    public string $method;

    /**
     * Create a new component instance.
     *
     * @param  string  $method  The request method.
     * @return void
     */
    public function __construct(string $method)
    {
        $this->method = $method;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|Closure|string
     */
    public function render(): View|Closure|string
    {
        return view('components.http-log.request-method');
    }
}
