<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-4 py-2 bg-green-600 dark:bg-gray-300 hover:bg-green-400  border border-gray-300 dark:border-gray-500 rounded-md  font-semibold text-xs hover:text-white dark:text-gray-300 uppercase tracking-widest shadow-sm  dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
