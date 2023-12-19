
<aside id="sidebar" class="pt-12 fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0 bg-gray-50 dark:bg-gray-800" aria-label="Sidebar">
    <div class="h-full px-3 py-21 overflow-y-auto">
       <ul class="space-y-2 font-medium">
 
          <x-sidebar-item href="{{ route('backend.user.data.index') }}" icon="user" label="Profile"/>
          
          <x-sidebar-item href="{{ route('backend.user.cart.create') }}" icon="shopping-cart" label="Cart"/>

          <x-sidebar-item href="{{ route('backend.user.order.index') }}" icon="file" label="Order"/>
          
       </ul>
       <ul class="pt-4 mt-4 space-y-2 font-medium border-t border-t-solid border-gray-800 dark:border-gray-300">

          <x-sidebar-item href="{{ route('auth.logout') }}" icon="right-from-bracket" label="Logout"/>
 
       </ul>
    </div>
 </aside>