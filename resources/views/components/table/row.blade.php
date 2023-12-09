
<tr>
    <td class="w-4 p-4">
        <div class="flex items-center">
            <input id="checkbox-table-1" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
            <label for="checkbox-table-1" class="sr-only">checkbox</label>
        </div>
    </td>
    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
        {{ $attributes['name'] }}
    </th>
    <td class="px-6 py-4">
        {{ $attributes['email'] }}
    </td>
    <td class="px-6 py-4">
        {{ $attributes['role'] }}
    </td>
    <td class="px-6 py-4">
        <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
    </td>
</tr>