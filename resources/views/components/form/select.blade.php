<div class="grid grid-cols-1 md:grid-cols-3 gap-x-4 items-center mb-3">
    <div class="mb-2 md:mb-0">
        <label for="{{ $id ?? 'select' }}" class="block text-sm md:text-lg font-medium text-gray-900">{{ $label
            }}</label>
        <span class="text-xs font-medium text-gray-400">{{ $description }}</span>
    </div>
    <div class="md:col-span-2">
        <input id="{{ $id ?? 'select' }}" name="{{ $name ?? $id ?? 'select' }}" list="{{ $id ?? 'select' }}-datalist"
            value="{{ $selected ?? '' }}" placeholder="{{ $placeholder }}"
            class="block w-full p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
            autocomplete="off">
        <datalist id="{{ $id ?? 'select' }}-datalist">
            @foreach ($options as $data)
            <option value="{{ $data[$valueField] }}">{{ $data[$displayField] }}</option>
            @endforeach
        </datalist>
    </div>
</div>