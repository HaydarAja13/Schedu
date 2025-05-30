<div class="grid grid-cols-1 md:grid-cols-3 gap-x-4 items-center mb-3  ">
    <div class="mb-2 md:mb-0">
        <label for="{{ $id ?? 'select' }}" class="block text-sm md:text-lg font-medium text-gray-900">{{ $label }}</label>
        <span class="text-xs font-medium text-gray-400">{{ $description }}</span>
    </div>
    <select id="{{ $id ?? 'select' }}" name="{{ $name ?? $id ?? 'select' }}"
        class="block w-full p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 md:col-span-2">
        <option value="" {{ !isset($selected) ? 'selected' : '' }} disabled>{{ $placeholder }}</option>
        @foreach ($options as $data)
        <option value="{{ $data[$valueField] }}" {{ isset($selected) && $data[$valueField] == $selected ? 'selected' : '' }}>{{ $data[$displayField] }}</option>
        @endforeach
    </select>
</div>
