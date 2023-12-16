<?php

namespace App\View\Components\table;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class row extends Component
{
    /**
     * Create a new component instance.
     */

    public $name;
    public $email;
    public $role;

    public function __construct(

    )
    {
 
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.table.row');
    }
}
