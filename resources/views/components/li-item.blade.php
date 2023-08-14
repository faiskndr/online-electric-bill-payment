@props(['active'])

@php
$classes = ($active ?? false)
            ? 'nav-item menu-open'
            : 'nav-item';
@endphp
<li {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</li>