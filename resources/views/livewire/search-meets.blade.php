<div class="pb-4 px-4" >
    <div class="flex items-center justify-between mb-4" >
        <h1 class="font-semibold text-xl" >Find your meet</h1 >
        <a href="{{ route('meets.upload') }}"
           class="inline-flex items-center px-2 py-1.5 border border-transparent font-semibold shadow-sm text-sm rounded-md text-white bg-teal-500 dark:hover:bg-teal-600 hover:bg-teal-600 transition ease-in-out duration-150" >
            <svg xmlns="http://www.w3.org/2000/svg" class="-ml-0.5 mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor" stroke-width="2" >
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
            </svg >
            Upload a Program
        </a >
    </div >

    <div class="flex justify-end my-4" >
        <input type="text" wire:model.debounce.750ms="search" name="search" id="search"
               placeholder="Search for a meet..."
               class="py-2 w-full sm:block dark:placeholder:text-gray-300 focus:ring-0 focus:border-gray-500 active:ring-0 ring-0 dark:bg-gray-800 border-gray-300 dark:border-gray-700 text-base sm:text-sm rounded-md" >
    </div >

    <ul >
        @forelse ($meets as $meet)
            <li >
                <div
                    class="my-4 p-4 block border border-gray-400 shadow dark:border-gray-500 rounded-md hover:bg-teal-50 dark:hover:bg-gray-800" >
                    <a class="truncate font-semibold text-lg text-gray-800 dark:text-gray-300"
                       href="{{route('meets.show', $meet)}}" >
                        <div class="space-y-1" >
                            <div class="truncate" >{{ $meet->name }}</div >
                            <div class="text-sm text-gray-700 dark:text-gray-400 truncate" >{{ $meet->location }}</div >
                            <div class="text-sm text-gray-600 dark:text-gray-500 truncate" >{{ $meet->when }}</div >
                            <div class="pt-2 " >
                                <x-meet-stats :meet="$meet" />
                            </div >
                            @if($meet->updated_at->greaterThan($meet->created_at))
                                <div class="text-xs text-cyan-600 dark:text-cyan-500 italic pt-2" >
                                    Updated {{ $meet->updated_at->diffForHumans() }}</div >
                            @endif
                        </div >
                    </a >
                </div >
            </li >
        @empty
            <div class="dark:text-gray-300 text-gray-800" >No meet names match your search</div >
        @endforelse
    </ul >
</div >
