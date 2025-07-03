@php
// Cari display value berdasarkan selected ID
$selectedDisplay = '';
if (!empty($selected) && !empty($options)) {
foreach ($options as $data) {
if ($data[$valueField] == $selected) {
$selectedDisplay = $data[$displayField];
break;
}
}
}
@endphp

{{-- Solusi 1: Menggunakan JavaScript untuk handle behavior datalist --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-x-4 items-center mb-6">
    <div class="mb-2 md:mb-0 grid">
        <label for="{{ $id ?? 'select' }}" class="block text-sm md:text-base text-gray-900">{{ $label }}</label>
        <span class="text-xs text-gray-400">{{ $description }}</span>
    </div>
    <div class="md:col-span-2">
        {{-- Input yang tampil untuk user --}}
        <input id="{{ $id ?? 'select' }}" list="{{ $id ?? 'select' }}-datalist" value="{{ $selectedDisplay }}"
            placeholder="{{ $placeholder }}"
            class="block w-full px-3 py-1.5 text-sm text-gray-700 rounded-md outline-1 -outline-offset-1 outline-gray-300 bg-gray-50 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-purple-500"
            autocomplete="off" onchange="handleDatalistChange(this, '{{ $id ?? 'select' }}-hidden')">

        {{-- Datalist options --}}
        <datalist id="{{ $id ?? 'select' }}-datalist">
            @foreach ($options as $data)
            <option value="{{ $data[$displayField] }}" data-id="{{ $data[$valueField] }}">{{ $data[$displayField] }}
            </option>
            @endforeach
        </datalist>

        {{-- Hidden input yang akan dikirim ke server --}}
        <input type="hidden" name="{{ $name ?? $id ?? 'select' }}" id="{{ $id ?? 'select' }}-hidden"
            value="{{ $selected ?? '' }}">
    </div>
</div>

<script>
    function handleDatalistChange(inputElement, hiddenInputId) {
        const selectedValue = inputElement.value;
        const datalistId = inputElement.getAttribute('list');
        const datalist = document.getElementById(datalistId);
        const hiddenInput = document.getElementById(hiddenInputId);

        // Cari option yang sesuai dengan value yang dipilih
        const selectedOption = datalist.querySelector(`option[value="${selectedValue}"]`);

        if (selectedOption) {
            // Jika ditemukan, set hidden input dengan data-id
            hiddenInput.value = selectedOption.getAttribute('data-id');
        } else {
            // Jika tidak ditemukan (user mengetik manual), kosongkan hidden input
            hiddenInput.value = '';
        }
    }
</script>