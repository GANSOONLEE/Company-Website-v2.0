
@inject('orders', 'App\Domains\Order\Models\Order')

<aside id="logo-sidebar" class="pt-12 fixed top-0 left-0 z-[31] w-[16rem] h-screen transition-transform -translate-x-full md:!translate-x-[0px] bg-gray-50 dark:bg-gray-800" aria-label="Sidebar">
   <div class="h-full px-3 py-8 overflow-y-auto">
      <ul class="space-y-2 font-medium">

         <x-sidebar-item href="{{ route('backend.admin.dashboard') }}" icon="dashboard" label="{{ __('sidebar.dashboard') }}"/>
         
         <x-sidebar-item href="{{ route('backend.admin.product.index') }}" icon="shopping-cart" label="{{ __('sidebar.product') }}"/>

         <x-sidebar-dropdown icon="car" label="{{ __('sidebar.model') }}">
            <x-sidebar-dropdown-item href="{{ route('backend.admin.model.create') }}" label="{{ __('sidebar.create-model') }}"/>
            <x-sidebar-dropdown-item href="{{ route('backend.admin.model.edit') }}" label="{{ __('sidebar.edit-model') }}" />
         </x-sidebar-dropdown>

         <x-sidebar-dropdown icon="box" label="{{ __('sidebar.category') }}">
            <x-sidebar-dropdown-item href="{{ route('backend.admin.category.create') }}" label="{{ __('sidebar.create-category') }}" />
            <x-sidebar-dropdown-item href="{{ route('backend.admin.category.edit') }}" label="{{ __('sidebar.edit-category') }}" />
         </x-sidebar-dropdown>
      
         <x-sidebar-dropdown icon="tag" label="{{ __('sidebar.brand') }}">
            <x-sidebar-dropdown-item href="{{ route('backend.admin.brand.create') }}" label="{{ __('sidebar.create-brand') }}" />
            <x-sidebar-dropdown-item href="{{ route('backend.admin.brand.edit') }}" label="{{ __('sidebar.edit-brand') }}" />
         </x-sidebar-dropdown>

         <x-sidebar-item href="{{ route('backend.admin.order.index') }}" icon="file" label="{{ __('sidebar.order') }}"/>

         <x-sidebar-item href="{{ route('backend.admin.image.index') }}" icon="image" label="{{ __('sidebar.carousel-image') }}"/>

      </ul>
      <ul class="pt-4 mt-4 space-y-2 font-medium border-t border-t-solid border-gray-800 dark:border-gray-300">

         <x-sidebar-dropdown icon="user-tie" label="{{ __('sidebar.management-center') }}">
            <x-sidebar-dropdown-item href="{{ route('backend.admin.user.index') }}" label="{{ __('sidebar.user-management-center') }}" />
            <x-sidebar-dropdown-item href="{{ route('backend.admin.role.index') }}" label="{{ __('sidebar.role-management-center') }}" />
            <x-sidebar-dropdown-item href="{{ route('backend.admin.permission.index') }}" label="{{ __('sidebar.permission-management-center') }}" />
            <x-sidebar-dropdown-item href="{{ route('backend.admin.notification.index') }}" label="{{ __('sidebar.notification-publish-center') }}" />
         </x-sidebar-dropdown>

         <x-sidebar-dropdown icon="database" label="{{ __('sidebar.data-center') }}">
            <x-sidebar-dropdown-item href="{{ route('backend.admin.data.record') }}" label="{{ __('sidebar.operation-record') }}" />
            <x-sidebar-dropdown-item href="{{ route('backend.admin.data.import') }}" label="{{ __('sidebar.import-data') }}" />
            <x-sidebar-dropdown-item href="{{ route('backend.admin.data.export') }}" label="{{ __('sidebar.export-data') }}" />
         </x-sidebar-dropdown>

         <x-sidebar-dropdown icon="globe" label="{{ __('sidebar.language') }}">
            <x-sidebar-dropdown-item href="{{ route('locale.change', ['lang' => 'en']) }}" label="English" />
            <x-sidebar-dropdown-item href="{{ route('locale.change', ['lang' => 'zh']) }}" label="中文" />
            <x-sidebar-dropdown-item href="{{ route('locale.change', ['lang' => 'zh-TW'])}}" label="繁體中文" />
         </x-sidebar-dropdown>

         <x-sidebar-item href="{{ route('translation') }}" icon="language" label="Translation Manager"/>

      </ul>
   </div>
</aside>