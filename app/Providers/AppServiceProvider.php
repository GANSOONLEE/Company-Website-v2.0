<?php

namespace App\Providers;

// Component
use App\View\Components\Alert;
use App\View\Components\Navbar;
use App\View\Components\Sidebar;
use App\View\Components\Sidebar\SidebarItem;
use App\View\Components\Sidebar\SidebarDropdown;
use App\View\Components\Sidebar\SidebarDropdownItem;

// Laravel Support
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

// Model
use App\Domains\Auth\Models\User;

// Enum
use App\Domains\Common\Enums\Sort;

// Builder
use Yajra\DataTables\Html\Builder;

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
        // Component
        Blade::component('package-alert', Alert::class);
        Blade::component('navbar', Navbar::class);
        Blade::component('sidebar', Sidebar::class);
        Blade::component('sidebar-item', SidebarItem::class);
        Blade::component('sidebar-dropdown', SidebarDropdown::class);
        Blade::component('sidebar-dropdown-item', SidebarDropdownItem::class);

        // Class
        view()->share('sortEnum', Sort::class);

        Builder::useVite();
    }
}
