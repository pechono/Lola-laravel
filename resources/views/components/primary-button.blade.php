<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-4 py-2 bg-blue dark:bg-blue-800 border border-blue-300 dark:border-blue-500 rounded-md font-semibold text-xs text-blue-700 dark:text-blue-300 uppercase tracking-widest shadow-sm hover:bg-blue-50 dark:hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-blue-800 disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
