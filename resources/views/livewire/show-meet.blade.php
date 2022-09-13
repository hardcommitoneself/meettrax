<div >
    <div class="pb-4 px-4" >
        <div class="block sm:flex items-center justify-between" >
            <div >
                <h1 class="text-xl font-semibold truncate" >{{ $meet->name }}</h1 >
            </div >
            <div class="mt-2 sm:mt-0 " >
                <x-meet-stats :meet="$meet" />
            </div >
        </div >
        <div class="text-xs mt-2 text-cyan-600 dark:text-cyan-500 italic flex items-center" >
            <p >{{ $views }} views</p >
            @if($meet->updated_at->greaterThan($meet->created_at))
                <p class="px-2" >&bull;</p >
                <p >Updated {{ $meet->updated_at->diffForHumans() }}</p >
            @endif
        </div >
        <div class="flex items-center space-x-4 mt-4" >
            <div class="mt-2 {{ $highlighted ? 'w-1/2' : 'w-full' }}" >
                <select wire:model="highlighted" id="highlighted" name="highlighted"
                        class="mt-1 w-full pl-3 focus:border-gray-300 focus:ring-0 pr-10 py-2 dark:bg-gray-800   text-gray-700 dark:text-gray-300 border-gray-300 dark:border-gray-700 rounded-md" >
                    <option value="" >Choose your school to highlight it...</option >
                    @foreach ($schools as $school)
                        <option value="{{ $school }}" >{{ $school }}</option >
                    @endforeach
                </select >
            </div >
            @if($highlighted)
                <!-- Toggle -->
                <div
                    x-data="{ value: $wire.hideOthers }"
                    class="mt-2 w-1/2 flex items-center"
                    x-id="['toggle-label']"
                >
                    <input type="hidden" name="hideOthers" :value="value" >

                    <!-- Button -->
                    <button
                        x-ref="toggle"
                        @click="value = ! value"
                        wire:model="hideOthers"
                        wire:click="toggleHideOthers"
                        type="button"
                        role="switch"
                        :aria-checked="value"
                        :aria-labelledby="$id('toggle-label')"
                        :class="value ? 'bg-teal-500 border border-white' : 'bg-gray-200 dark:bg-gray-400 border dark:border-gray-400 border-gray-400'"
                        class="mr-2 shrink-0 relative w-14 py-1 px-0 inline-flex rounded-full"
                    >
                        <span
                            :class="value ? 'bg-white translate-x-6' : 'bg-gray-700 translate-x-1'"
                            class="w-6 h-6 rounded-full transition"
                            aria-hidden="true"
                        ></span >
                    </button >

                    <!-- Label -->
                    <label
                        @click="$refs.toggle.click(); $refs.toggle.focus()"
                        :id="$id('toggle-label')"
                        class="text-gray-700 dark:text-gray-400"
                    >
                        Hide Other Schools
                    </label >

                </div >
            @endif
        </div >

        <div class="flex items-center space-x-4 mt-4" >
            <div class="flex-auto w-1/2" >
                <div class="relative h-9 w-full flex-shrink-0" searchable="true" >
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                         width="20"
                         height="24" class="inline-block absolute ml-2 text-gray-400" role="presentation"
                         style="top: 9px;" >
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" ></path >
                    </svg >
                    <input type="text" wire:model.debounce.750ms="search" name="search" id="search"
                           placeholder="Find athlete..."
                           class="px-9 py-2 w-full sm:block dark:placeholder:text-gray-300 focus:ring-0 focus:border-gray-500 active:ring-0 ring-0 dark:bg-gray-800 border-gray-300 dark:border-gray-700   rounded-md" >
                    @if($search)
                        <button class="px-1" wire:click="$set('search', '')" >
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                 viewBox="0 0 24 24" stroke="currentColor"
                                 class="w-7 inline-block absolute mt-px right-1 text-gray-400" role="presentation"
                                 style="top: 8px;" >
                                <path fill-rule="evenodd"
                                      d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                      clip-rule="evenodd" />
                            </svg >
                        </button >
                    @endif
                </div >
            </div >

            <div class="flex-auto w-1/2" >
                <div class="relative h-9 w-full flex-shrink-0" searchable="true" >
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                         width="20"
                         height="24" class="inline-block absolute ml-2 text-gray-400" role="presentation"
                         style="top: 9px;" >
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" ></path >
                    </svg >
                    <input type="text" wire:model.debounce.750ms="searchEvents" name="searchEvents" id="searchEvents"
                           placeholder="Find event..."
                           class="px-9 py-2 w-full sm:block dark:placeholder:text-gray-300 focus:ring-0 focus:border-gray-500 active:ring-0 ring-0 dark:bg-gray-800 border-gray-300 dark:border-gray-700   rounded-md" >
                    @if($searchEvents)
                        <button class="px-1" wire:click="$set('searchEvents', '')" >
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                 viewBox="0 0 24 24" stroke="currentColor"
                                 class="w-7 inline-block absolute mt-px right-1 text-gray-400" role="presentation"
                                 style="top: 8px;" >
                                <path fill-rule="evenodd"
                                      d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                      clip-rule="evenodd" />
                            </svg >
                        </button >
                    @endif
                </div >
            </div >
        </div >

        <div class="bg-white dark:bg-gray-900 overflow-hidden" >

            <div class="mt-4 mb-6" >
                <label class="text-xs uppercase dark:text-gray-500" >Group By</label >
                <div class="mt-1 flex items-center justify-between" >
                    <div class="flex items-center" >
                        <x-primary-button class="w-full py-1" :group-left="true" :active="$groupBy == 'event'"
                                          wire:click="$set('groupBy', 'event')" >
                            <span class="flex-shrink-0 mx-auto" >Event</span >
                        </x-primary-button >
                        <x-primary-button class="w-full py-1" :group-right="true" :active="$groupBy == 'athlete'"
                                          wire:click="$set('groupBy', 'athlete')" >
                            <span class="flex-shrink-0 mx-auto" >Athlete</span >
                        </x-primary-button >
                    </div >

                    <div class="flex items-center justify-end px-2" >
                        <div class="flex items-center justify-end space-x-3 text-teal-500" >
                            <button @click="$dispatch('closeall')" title="Close all events" >
                                <div class="flex items-center whitespace-nowrap space-x-1" >
                                    <svg class="h-5 w-5 text-teal-400" xmlns="http://www.w3.org/2000/svg"
                                         fill="currentColor"
                                         viewBox="0 0 448 512" >
                                        <path
                                            d="M128 320H32c-17.69 0-32 14.31-32 32s14.31 32 32 32h64v64c0 17.69 14.31 32 32 32s32-14.31 32-32v-96C160 334.3 145.7 320 128 320zM416 320h-96c-17.69 0-32 14.31-32 32v96c0 17.69 14.31 32 32 32s32-14.31 32-32v-64h64c17.69 0 32-14.31 32-32S433.7 320 416 320zM320 192h96c17.69 0 32-14.31 32-32s-14.31-32-32-32h-64V64c0-17.69-14.31-32-32-32s-32 14.31-32 32v96C288 177.7 302.3 192 320 192zM128 32C110.3 32 96 46.31 96 64v64H32C14.31 128 0 142.3 0 160s14.31 32 32 32h96c17.69 0 32-14.31 32-32V64C160 46.31 145.7 32 128 32z" />
                                    </svg >
                                    <p class="hover:text-teal-400" >Close All</p >
                                </div >
                            </button >
                            <button @click="$dispatch('openall')" title="Open all events" >
                                <div class="flex items-center whitespace-nowrap space-x-1" >
                                    <svg class="h-5 w-5 text-teal-400" xmlns="http://www.w3.org/2000/svg"
                                         fill="currentColor"
                                         viewBox="0 0 448 512" >
                                        <path
                                            d="M128 32H32C14.31 32 0 46.31 0 64v96c0 17.69 14.31 32 32 32s32-14.31 32-32V96h64c17.69 0 32-14.31 32-32S145.7 32 128 32zM416 32h-96c-17.69 0-32 14.31-32 32s14.31 32 32 32h64v64c0 17.69 14.31 32 32 32s32-14.31 32-32V64C448 46.31 433.7 32 416 32zM128 416H64v-64c0-17.69-14.31-32-32-32s-32 14.31-32 32v96c0 17.69 14.31 32 32 32h96c17.69 0 32-14.31 32-32S145.7 416 128 416zM416 320c-17.69 0-32 14.31-32 32v64h-64c-17.69 0-32 14.31-32 32s14.31 32 32 32h96c17.69 0 32-14.31 32-32v-96C448 334.3 433.7 320 416 320z" />
                                    </svg >
                                    <p class="hover:text-teal-400" >Open All</p >
                                </div >
                            </button >
                        </div >
                    </div >
                </div >
            </div >

            @if(!empty($meet->scoreboard_url))
                <div x-data="{open: true}" x-cloak @openall.window="open = true" @closeall.window="open = false" >
                    <div @click="open = !open" class="cursor-pointer border-b" >
                        <div class="px-2 py-4" >
                            <div class="w-full flex items-center justify-between space-x-2" >
                                <div class="flex items-center space-x-2 text-green-500" >
                                    <x-live-pulse />
                                    <h3 class="text-teal-500 text-lg leading-5 font-semibold uppercase truncate" >
                                        live scoreboard</h3 >
                                </div >
                                <svg xmlns="http://www.w3.org/2000/svg" class="text-gray-400 h-5 w-5"
                                     :class="open ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24"
                                     stroke="currentColor"
                                     stroke-width="2" >
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                </svg >
                            </div >
                            <div x-show="open" x-collapse.duration.1000ms
                                 class="ext-black dark:text-gray-200" >
                                <div
                                    class="mt-2 md:justify-center flex flex-col md:flex-row md:space-x-4 md:space-y-0 space-y-4 space-x-0" >
                                    <x-live-scoreboard-embed url="{{ $meet->scoreboard_url }}" />
                                    @if(!empty($meet->scoreboard_2_url))
                                        <x-live-scoreboard-embed url="{{ $meet->scoreboard_2_url }}" />
                                    @endif
                                </div >

                            </div >
                        </div >
                    </div >
                </div >
            @endif

            <div class="flex justify-center" >
                <div wire:loading wire:target="toggleHideOthers" class="py-8" >
                    <svg class="animate-spin -ml-1 mr-3 h-24 w-24 text-gray-800 dark:text-white"
                         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" >
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                stroke-width="4" ></circle >
                        <path class="opacity-75" fill="currentColor"
                              d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z" ></path >
                    </svg >
                </div >
            </div >

            @if ($updates->count() > 0)
                <div x-data="{open: true}" x-cloak @openall.window="open = true" @closeall.window="open = false" >
                    <div @click="open = !open" class="cursor-pointer border-b" >
                        <div class="py-4" >
                            <div class="px-2 w-full flex items-center justify-between space-x-2" >
                                <div class="flex items-center space-x-2 text-green-500" >
                                    <x-live-pulse />
                                    <h3 class="text-teal-500 text-lg leading-5 font-semibold uppercase truncate" >
                                        live field events feed</h3 >
                                </div >
                                <svg xmlns="http://www.w3.org/2000/svg" class="text-gray-400 h-5 w-5"
                                     :class="open ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24"
                                     stroke="currentColor"
                                     stroke-width="2" >
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                </svg >
                            </div >

                            <div x-show="open" x-collapse.duration.1000ms
                                 class="  text-black dark:text-gray-200" >
                                <div class="px-4 mt-2 flex items-center justify-between" >
                                    <p class="text-xs" >
                                        Updated: {{ now()->timezone('America/Boise')->format('g:i A') }}</p >
                                </div >
                                <ul class="mt-4  " >
                                    @foreach($updates as $update)
                                        <li class="px-2 py-1 border-gray-300 dark:border-gray-600 first:border-t border-b border-dashed {{ (!empty($update->body['results'][0]['affiliation']) && $update->body['results'][0]['affiliation'] === session('meet.'.$meet->id.'.highlighted')) ? 'dark:bg-gray-700 dark:text-teal-300 bg-teal-100 font-black' : '' }}" >
                                            <div class="flex items-center justify-between" >
                                                <div
                                                    class="px-2 text-sm text-{{ $update->meetEvent->textColor }} truncate" >{{ $update->body['results_header']['event_name']  }}</div >
                                                <p class="text-sm dark:text-gray-600 px-2 text-gray-500" >{{ $update->created_at->timezone('America/Boise')->format('g:i A') }}</p >
                                            </div >
                                            <div class="flex items-center" >
                                                <div
                                                    class="w-5/12 mx-2 truncate" >{{ $update->body['results'][0]['name']  }}</div >
                                                <div
                                                    class="w-2/12 text-right mx-2" >{{ $update->body['results'][0]['affiliation'] }}</div >
                                                <div
                                                    class="w-5/12 mx-2 text-right  whitespace-nowrap" >{{ $update->impericalMark }} {!! $update->markSuffix ? '&nbsp; '.$update->markSuffixHtml : '' !!}</div >
                                            </div >
                                        </li >
                                    @endforeach
                                </ul >
                                <div class="mt-2" >
                                    {{ $updates->links() }}
                                </div >
                            </div >

                        </div >
                    </div >
                </div >
            @endif

            <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700 " >
                @if($groupBy === 'event' && isset($events))
                    @foreach($events as $event)
                        @if($event->sections->count() > 0)
                            <x-meet-event-card :meet-event="$event" :highlighted="$highlighted" :search="$search"
                                               :hide-others="$hideOthers" />
                        @endif
                    @endforeach
                @endif
                @if($groupBy === 'athlete' && isset($athletes))
                    @foreach($athletes as $athlete)
                        <x-meet-athlete-card :meet="$meet" :highlighted="$highlighted" :athlete="$athlete" />
                    @endforeach
                @endif
            </ul >
        </div >
    </div >

    <x-modal name="event-update-modal" >
        <livewire:show-meet-event />
    </x-modal >

    <x-modal name="event-runnercard-modal" >
        <iframe
            class="mt-4"
            style="min-height: 80vh; max-height: 80vh; width: 100%; height: 100%; background: white;"
            x-data="{ url: '' }"
            :src="url"
            @event-runnercard-modal.window="url = `https://results.runnercard.com/Results/resultsFrame.jsp?meet=${$event.detail.runnercard_meet_id}&event=${$event.detail.runnercard_event_id}&round=1`"
            @event-runnercard-modal-close-modal.window="url = ''"
        ></iframe>
    </x-modal >
</div >
