@props(['type' => 'success', 'title' => 'Thông báo'])

@php
    $classes = $type === 'success'
        ? 'bg-green-50 text-green-800'
        : 'bg-yellow-50 text-yellow-800';
@endphp

<div class="p-3 rounded-lg mb-2 {{ $classes }}">
    <strong>{{ $title }}:</strong> {{ $slot }}
</div>
