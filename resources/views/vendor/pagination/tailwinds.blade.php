<!-- resources/views/vendor/pagination/tailwind.blade.php -->
<div class="flex justify-between items-center mt-4">
    <div>
        <p class="text-sm text-gray-700">
            Menampilkan <span class="font-semibold">{{ $paginator->firstItem() }}</span> sampai <span class="font-semibold">{{ $paginator->lastItem() }}</span> dari <span class="font-semibold">{{ $paginator->total() }}</span> hasil
        </p>
    </div>
    <div>
        <nav role="navigation" aria-label="Pagination Navigation" class="flex">
            @if ($paginator->onFirstPage())
                <span class="disabled relative inline-flex items-center px-4 py-2 text-gray-300 bg-gray-200 border border-gray-300 rounded-l-md cursor-default">
                    &laquo; Sebelumnya
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="relative inline-flex items-center px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-l-md hover:bg-gray-100 focus:outline-none focus:ring focus:ring-blue-300">
                    &laquo; Sebelumnya
                </a>
            @endif

            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span class="disabled relative inline-flex items-center px-4 py-2 text-gray-300 bg-gray-200 border border-gray-300 cursor-default">{{ $element }}</span>
                @endif

                {{-- Array Of Links --}}
                if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="disabled relative inline-flex items-center px-4 py-2 text-white bg-blue-500 border border-blue-500 cursor-default">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="relative inline-flex items-center px-4 py-2 text-gray-700 bg-white border border-gray-300 hover:bg-gray-100 focus:outline-none focus:ring focus:ring-blue-300">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="relative inline-flex items-center px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-r-md hover:bg-gray-100 focus:outline-none focus:ring focus:ring-blue-300">
                    Selanjutnya &raquo;
                </a>
            @else
                <span class="disabled relative inline-flex items-center px-4 py-2 text-gray-300 bg-gray-200 border border-gray-300 rounded-r-md cursor-default">
                    Selanjutnya &raquo;
                </span>
            @endif
        </nav>
    </div>
</div>
