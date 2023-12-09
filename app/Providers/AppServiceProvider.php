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

use App\Domains\Auth\Models\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if ($this->app->environment('local')) {
            $this->app->register(\Laravel\Tinker\TinkerServiceProvider::class);
        }
    
        // Add the following line
        $this->app->alias(User::class, 'User');
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
