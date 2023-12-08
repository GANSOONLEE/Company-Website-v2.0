<?php

namespace App\Providers;

use App\View\Components\Alert;

use App\View\Components\Navbar;

use App\View\Components\Sidebar;
use App\View\Components\Sidebar\SidebarItem;
use App\View\Components\Sidebar\SidebarDropdown;
use App\View\Components\Sidebar\SidebarDropdownItem;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Blade::component('package-alert', Alert::class);

        Blade::component('navbar', Navbar::class);

        Blade::component('sidebar', Sidebar::class);
        Blade::component('sidebar-item', SidebarItem::class);
        Blade::component('sidebar-dropdown', SidebarDropdown::class);
        Blade::component('sidebar-dropdown-item', SidebarDropdownItem::class);
    }
}
