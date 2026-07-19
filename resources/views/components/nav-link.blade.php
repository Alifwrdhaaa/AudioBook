@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-[4px] border-indigo-600 text-xs font-black uppercase tracking-widest leading-5 text-slate-800 focus:outline-none transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1 pt-1 border-b-[4px] border-transparent text-xs font-bold uppercase tracking-widest leading-5 text-slate-400 hover:text-slate-600 hover:border-slate-200 focus:outline-none focus:text-slate-700 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
