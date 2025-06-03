<form method="GET" action="{{ $action }}" class="w-full">
    <div class="mt-2">
        <div class="flex rounded-md bg-white outline outline-1 -outline-offset-1 outline-gray-300 focus-within:outline focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
            <input type="text" name="search" id="search" value="{{ request('search') }}"
                   class="block min-w-0 grow px-3 py-1.5 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm"
                   placeholder="{{ $placeholder ?? 'Rechercher...' }}">
            <div class="flex py-1.5 pr-1.5">
                <kbd class="inline-flex items-center rounded border border-gray-200 px-1 font-sans text-xs text-gray-400">🔎</kbd>
            </div>
        </div>
    </div>
</form>
