<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-[#1a424a] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#235862] focus:bg-[#235862] active:bg-[#15363d] focus:outline-none focus:ring-2 focus:ring-[#44936d] focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
