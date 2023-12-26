
<tr class="hover:bg-gray-200 dark:hover:bg-gray-800">
    {{-- <td class="w-4 p-4">
        <div class="flex items-center">
            <input id="checkbox-table-1" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-25 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
            <label for="checkbox-table-1" class="sr-only">checkbox</label>
        </div>
    </td> --}}
    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
        {{ $attributes['name'] }}
    </th>
    <td class="px-6 py-4" data-column="email">
        {{ $attributes['email'] }}
    </td>
    <td class="px-6 py-4" data-column="role">
        {{ $attributes['role'] }}
    </td>
    <td class="flex justify-between items-center px-6 py-4">
        <button data-bs-toggle="modal" data-bs-target="#editModalForm" id="editButton" class="font-medium text-blue-600 dark:text-blue-500 hover:underline disabled:text-gray-600 disabled:hover:no-underline disabled:text-slate-700 disabled:cursor-not-allowed dark:disabled:text-slate-700" {{ $attributes['weight'] }} >@lang('Edit')</button>
        @if ($attributes['areTrashed'])
            <x-form.delete :action="route('backend.admin.user.delete', ['id' => $attributes['id']])">
                <button class="font-medium text-red-600 dark:text-red-500 hover:underline disabled:text-gray-600 disabled:hover:no-underline disabled:text-slate-700 disabled:cursor-not-allowed dark:disabled:text-slate-700" {{ $attributes['weight'] }} >@lang('Delete')</button>
            </x-form.delete>
        @else
            <x-form.patch :action="route('backend.admin.user.restore', ['id' => $attributes['id']])">
                <button class="font-medium text-green-600 dark:text-green-500 hover:underline disabled:text-gray-600 disabled:hover:no-underline disabled:text-slate-700 disabled:cursor-not-allowed dark:disabled:text-slate-700" {{ $attributes['weight'] }} >@lang('Restore')</button>
            </x-form.patch>
        @endif
    </td>
</tr>