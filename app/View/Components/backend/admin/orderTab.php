<?php

namespace App\View\Components\backend\admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class orderTab extends Component
{

    public $tabs;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->tabs = [
            (object)[
                'id' => 'pending-tab',
                'dataTabsTarget' => 'pending',
                'name' => trans('order.pending'),
                'slot' => 'pending',
            ],
            (object)[
                'id' => 'accepted-tab',
                'dataTabsTarget' => 'accepted',
                'name' => trans('order.accepted'),
                'slot' => 'accepted',
            ],
            (object)[
                'id' => 'process-tab',
                'dataTabsTarget' => 'process',
                'name' => trans('order.process'),
                'slot' => 'process',
            ],
            (object)[
                'id' => 'placed-tab',
                'dataTabsTarget' => 'placed',
                'name' => trans('order.placed'),
                'slot' => 'placed',
            ],
            (object)[
                'id' => 'completed-tab',
                'dataTabsTarget' => 'completed',
                'name' => trans('order.completed'),
                'slot' => 'completed',
            ],
        ];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $tabs = $this->tabs;
        return view('components.backend.admin.order-tab', compact('tabs'));
    }
}
