<div class="grid grid-cols-1 md:grid-cols-3 gap-x-4 items-center mb-6">
    <div class="mb-2 md:mb-0 grid">
        <label for="{{ $id ?? 'select' }}" class="block text-sm md:text-base text-gray-900">{{ $label
            }}</label>
        <span class="text-xs text-gray-400">{{ $description }}</span>
    </div>
    <div class="md:col-span-2">
        <input id="{{ $id ?? 'select' }}" name="{{ $name ?? $id ?? 'select' }}" list="{{ $id ?? 'select' }}-datalist"
            value="{{ $selected ?? '' }}" placeholder="{{ $placeholder }}" 
            class="block w-full px-3 py-1.5 text-sm text-gray-700 rounded-md outline-1 -outline-offset-1 outline-gray-300 bg-gray-50 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-purple-500"
            autocomplete="off">
        <datalist id="{{ $id ?? 'select' }}-datalist">
            @foreach ($options as $data)
            <option value="{{ $data[$valueField] }}">{{ $data[$displayField] }}</option>
            @endforeach
        </datalist>
    </div>
</div>