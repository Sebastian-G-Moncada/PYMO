@props(['value','input'])

<label {{ $attributes->merge(['class' => 'inline-flex flex-col gap-2 font-medium text-sm text-gray-700']) }}>
    {{ $value ?? $slot }}
    @if (isset($input))
    {{$input}}
    @endif
</label>