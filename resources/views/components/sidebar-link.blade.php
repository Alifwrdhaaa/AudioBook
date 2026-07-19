@props(['active'])

@php
$classes = ($active ?? false)
            ? 'flex items-center gap-3 px-4 py-3 text-sm font-semibold text-white bg-[#44936d] rounded-xl transition-all duration-200 shadow-sm'
            : 'flex items-center gap-3 px-4 py-3 text-sm font-medium text-slate-300 hover:text-white hover:bg-[#235862] rounded-xl transition-all duration-200';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    @isset($icon)
        <span class="{{ ($active ?? false) ? 'text-white' : 'text-[#30b37f]' }} opacity-90 group-hover:opacity-100">
            {{ $icon }}
        </span>
    @endisset
    <span>{{ $slot }}</span>
</a>
