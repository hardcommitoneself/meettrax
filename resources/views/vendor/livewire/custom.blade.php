@if ($paginator->hasPages())
    <div class="flex items-end px-4 py-2" >

        @if ( ! $paginator->onFirstPage())
            {{-- First Page Link --}}
            <a
                class="px-2 py-1 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-800 text-white font-bold text-center hover:bg-blue-400 hover:border-blue-400 rounded-lg  cursor-pointer"
                wire:click="gotoPage(1)"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" >
                    <path fill-rule="evenodd"
                          d="M15.707 15.707a1 1 0 01-1.414 0l-5-5a1 1 0 010-1.414l5-5a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 010 1.414zm-6 0a1 1 0 01-1.414 0l-5-5a1 1 0 010-1.414l5-5a1 1 0 011.414 1.414L5.414 10l4.293 4.293a1 1 0 010 1.414z"
                          clip-rule="evenodd" />
                </svg >
            </a >
            @if($paginator->currentPage() > 2)
                {{-- Previous Page Link --}}
                <a
                    class="px-2 py-1 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-800 text-white font-bold text-center hover:bg-blue-400 hover:border-blue-400 rounded-lg  cursor-pointer"
                    wire:click="previousPage"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" >
                        <path fill-rule="evenodd"
                              d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                              clip-rule="evenodd" />
                    </svg >
                </a >
            @endif
        @endif

    <!-- Pagination Elements -->
        @foreach ($elements as $element)
        <!-- Array Of Links -->
            @if (is_array($element))
                @foreach ($element as $page => $url)
                <!--  Use three dots when current page is greater than 3.  -->
                    @if ($paginator->currentPage() > 3 && $page === 2)
                        <div class="text-blue-800 mx-1" >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                 fill="currentColor" >
                                <path
                                    d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                            </svg >
                        </div >
                    @endif

                <!--  Show active page two pages before and after it.  -->
                    @if ($page == $paginator->currentPage())
                        <span
                            class="mx-1 px-4 py-2 border-2 border-blue-400 bg-blue-400 text-white font-bold text-center hover:bg-blue-800 hover:border-blue-800 rounded-lg  cursor-pointer" >{{ $page }}</span >
                    @elseif ($page === $paginator->currentPage() + 1 || $page === $paginator->currentPage() + 2 || $page === $paginator->currentPage() - 1 || $page === $paginator->currentPage() - 2)
                        <a class="mx-1 px-4 py-2 border-2 border-blue-900 text-blue-900 font-bold text-center hover:text-blue-400 rounded-lg  cursor-pointer"
                           wire:click="gotoPage({{$page}})" >{{ $page }}</a >
                    @endif

                <!--  Use three dots when current page is away from end.  -->
                    @if ($paginator->currentPage() < $paginator->lastPage() - 2  && $page === $paginator->lastPage() - 1)
                        <div class="text-blue-800 mx-1" >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                 fill="currentColor" >
                                <path
                                    d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                            </svg >
                        </div >
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            @if($paginator->lastPage() - $paginator->currentPage() >= 2)
                <a class="mx-1 px-4 py-2 bg-blue-900 border-2 border-blue-900 text-white font-bold text-center hover:bg-blue-400 hover:border-blue-400 rounded-lg  cursor-pointer"
                   wire:click="nextPage"
                   rel="next" >
                    >
                </a >
            @endif
            <a
                class="mx-1 px-4 py-2 bg-blue-900 border-2 border-blue-900 text-white font-bold text-center hover:bg-blue-400 hover:border-blue-400 rounded-lg  cursor-pointer"
                wire:click="gotoPage({{ $paginator->lastPage() }})"
            >
                >>
            </a >
        @endif
    </div >
@endif
