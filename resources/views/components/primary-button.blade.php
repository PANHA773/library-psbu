@props(['disabled' => false])

<button {{ $attributes->merge([
    'type' => 'submit',
    'class' => 'bg-blue-600 text-white font-semibold py-2 px-4 rounded hover:bg-blue-700 disabled:opacity-50 disabled:cursor-not-allowed'
]) }} @if($disabled) disabled @endif>
    {{ $slot }}
</button>
