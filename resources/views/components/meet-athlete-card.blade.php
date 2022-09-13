<div x-data="{open: false}" x-cloak @openall.window="open = true" @closeall.window="open = false" >
    <li @click="open = !open" class="cursor-pointer" >
        <div
            class="px-2 py-4 {{ (!empty($athlete->first()->school) && $athlete->first()->school === $highlighted) ? 'text-teal-300 border-l-4 border-teal-300' : '' }}" >
            <div
                class="w-full flex items-center justify-between space-x-4" >
                <div class="w-6/12 truncate" >
                    <h3 class="text-{{ $textColor  }} text-lg sm:text-base leading-5 font-semibold uppercase truncate" >{{$athlete->first()->name }}</h3 >
                </div >
                <div class="1/12" >
                    <p class="text-sm text-right uppercase whitespace-nowrap {{ (!empty($athlete->first()->school) && $athlete->first()->school === $highlighted) ? 'font-black' : '' }}" >{{ $athlete->first()->grade }}</p >
                </div >
                <div class="1/12" >
                    <p class="text-sm text-right whitespace-nowrap {{ (!empty($athlete->first()->school) && $athlete->first()->school === $highlighted) ? 'font-black' : '' }}" >{{ $athlete->first()->school }}</p >
                </div >
                <div class="w-4/12 justify-end flex items-center space-x-2" >
                    <div
                        class="{{ (!empty($athlete->first()->school) && $athlete->first()->school === $highlighted) ? 'dark:text-teal-300 font-black' : 'text-gray-800 dark:text-gray-100' }}  text-sm  tracking-wide uppercase truncate" >{{ $athlete->count() }}
                        Entries
                    </div >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                         :class="open ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                         stroke-width="2" >
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg >
                </div >
            </div >
            <div x-show="open" x-collapse.duration.1000ms class="text-base sm:text-sm text-black dark:text-gray-200" >
                <div class="mb-4 my-2" >
                    <ul >
                        @foreach($athlete as $entry)
                            <li class="sm:px-4 py-1 flex justify-between border-gray-300 dark:border-gray-600 first:border-t border-b border-dashed" >
                                <div
                                    class="truncate" >{{ $entry->event->name . ' '. $entry->event->description }}</div >
                                <div class="pl-6 whitespace-nowrap " >
                                    <span class="font-semibold" >
                                        #{{ $entry->num }}</span >
                                    <span >{{ ' in '. $entry->section->name. ' '. $entry->section->num  }}</span >
                                </div >
                            </li >
                        @endforeach
                    </ul >
                </div >
            </div >
        </div >
    </li >
</div >
