<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\View\Components\Sidebar\SidebarItem;
use App\View\Components\Sidebar\SidebarDropdown;
use App\View\Components\Sidebar\SidebarDropdownItem;

class Sidebar extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public SidebarItem $sidebarItem,
        public SidebarDropdown $sidebarDropdown,
        public SidebarDropdownItem $sidebarDropdownItem
    ){}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('backend.components.sidebar');
        // ->with('sidebar-item', SidebarItem::class)
        // ->with('sidebar-dropdown', SidebarDropdown::class)
        // ->with('sidebar-dropdown-item', SidebarDropdownItem::class);
    }
}
