<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MankementList extends Component
{
    public $mankementjes;
    /**
     * Create a new component instance.
     */
    public function __construct($mankementjes)
    {
        $this->mankementjes = $mankementjes;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.mankement-list');
    }
}