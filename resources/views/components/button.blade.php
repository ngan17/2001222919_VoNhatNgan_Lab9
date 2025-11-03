@props(['variant' => 'primary'])

<button {{ $attributes->merge(['class' => $variant === 'danger' ? 'btn btn-danger' : 'btn btn-primary']) }}>
    {{ $slot }}
</button>
