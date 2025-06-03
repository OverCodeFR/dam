<div class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6">
    <div class="flex flex-1 justify-between sm:hidden">
        {{ $paginator->links('pagination::simple-tailwind') }}
    </div>
    <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
        <div class="text-sm text-gray-700">
            Affichage de {{ $paginator->firstItem() }} à {{ $paginator->lastItem() }} sur {{ $paginator->total() }} résultats
        </div>
        <div>
            {{ $paginator->links('pagination::tailwind') }}
        </div>
    </div>
</div>
