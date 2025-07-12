@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex justify-center mt-6">
        <ul class="inline-flex items-center space-x-1 text-sm">
            {{-- Previous --}}
            @if ($paginator->onFirstPage())
                <li>
                    <span
                        class="px-3 py-1 text-gray-400 bg-white dark:bg-gray-700 border border-gray-300 rounded-md cursor-not-allowed">
                        &laquo;
                    </span>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                        class="px-3 py-1 text-gray-700 dark:text-white bg-white dark:bg-gray-700 border border-gray-300 rounded-md hover:bg-gray-100 dark:hover:bg-gray-600">
                        &laquo;
                    </a>
                </li>
            @endif

            {{-- Page Numbers --}}
            @php
                $current = $paginator->currentPage();
                $last = $paginator->lastPage();
                $showMax = 5;
            @endphp

            @foreach ($elements as $element)
                @if (is_string($element))
                    <li><span class="px-3 py-1 text-gray-400">{{ $element }}</span></li>
                @endif

                @if (is_array($element))
                    @php $shown = 0; @endphp
                    @foreach ($element as $page => $url)
                        @if ($shown < $showMax || $page == $current)
                            @if ($page == $current)
                                <li>
                                    <span class="px-3 py-1 bg-bluePrimary text-white rounded-md">{{ $page }}</span>
                                </li>
                            @else
                                <li>
                                    <a href="{{ $url }}"
                                        class="px-3 py-1 text-gray-700 dark:text-white bg-white dark:bg-gray-700 border border-gray-300 rounded-md hover:bg-gray-100 dark:hover:bg-gray-600">
                                        {{ $page }}
                                    </a>
                                </li>
                            @endif
                            @php $shown++; @endphp
                        @elseif ($shown == $showMax)
                            <li><span class="px-3 py-1 text-gray-400">...</span></li>
                            @break
                        @endif
                    @endforeach
                @endif
            @endforeach


            {{-- Next --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                        class="px-3 py-1 text-gray-700 dark:text-white bg-white dark:bg-gray-700 border border-gray-300 rounded-md hover:bg-gray-100 dark:hover:bg-gray-600">
                        &raquo;
                    </a>
                </li>
            @else
                <li>
                    <span
                        class="px-3 py-1 text-gray-400 bg-white dark:bg-gray-700 border border-gray-300 rounded-md cursor-not-allowed">
                        &raquo;
                    </span>
                </li>
            @endif
        </ul>
    </nav>
@endif
