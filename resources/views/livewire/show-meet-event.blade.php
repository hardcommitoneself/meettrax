<div >
    @if ($meetEvent)

        <div class="text-xl -pt-4 -mt-4 font-semibold" >
            Updates for {{ $meetEvent->name }}
        </div >
        <div class="flex items-center justify-between" >
            <x-live-pulse />
            <p class="text-xs" >Updated: {{ now()->timezone('America/Boise')->format('g:i A') }}</p >
        </div >
        <div class="flex justify-center" >
            <div wire:loading wire:target="toggleHideOthers" class="py-8" >
                <svg class="animate-spin -ml-1 mr-3 h-24 w-24 text-gray-800 dark:text-white"
                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" >
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" ></circle >
                    <path class="opacity-75" fill="currentColor"
                          d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z" ></path >
                </svg >
            </div >
        </div >

        @if (isset($updates[0]))
            <div
                class="font-semibold  text-gray-600 dark:text-gray-400 my-2" > {{ $updates->last()->body['results_header']['heat_num'] }} {{ $meetEvent->sections[0]->name . ' of ' . $meetEvent->sections[0]->of }}</div >
        @endif

        <ul class="mt-4" >
            @foreach($updates as $update)
                <li class="px-2 py-1 flex items-center border-gray-300 dark:border-gray-600 first:border-t border-b border-dashed {{ (!empty($update->body['results'][0]['affiliation']) && $update->body['results'][0]['affiliation'] === $highlighted) ? 'dark:bg-gray-700 dark:text-teal-300 bg-teal-100 font-black' : '' }}" >
                    <div
                        class="w-5/12 truncate" >{{ $update->body['results'][0]['name']  }}</div >
                    <div
                        class="w-2/12 text-right mx-2" >{{ $update->body['results'][0]['affiliation'] }}</div >
                    <div
                        class="w-5/12 mx-2 text-right  whitespace-nowrap" >{{ $update->impericalMark }} {!! $update->markSuffix ? '&nbsp; '.$update->markSuffixHtml : '' !!}</div >
                </li >
            @endforeach
        </ul >
    @endif
</div >
