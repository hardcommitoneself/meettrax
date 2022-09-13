<div x-data="{open: false}" x-cloak @openall.window="open = true" @closeall.window="open = false" >
    <li @click="open = !open" class="cursor-pointer" >
        <div class="px-2 py-4" >
            <div class="w-full flex items-center justify-between space-x-2" >
                <h3 class="text-{{ $meetEvent->textColor }} leading-5 font-semibold uppercase truncate" >{{ $meetEvent->name }}</h3 >
                <div class="flex items-center space-x-2" >
                    <div
                        class="text-gray-800 text-xs dark:text-gray-100 tracking-wide uppercase truncate" >{{ $meetEvent->sections->count() }} {{ $meetEvent->description }}</div >
                    <svg xmlns="http://www.w3.org/2000/svg" class="text-gray-400 h-5 w-5"
                         :class="open ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                         stroke-width="2" >
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg >
                </div >
            </div >
            <div x-show="open" x-collapse.duration.1000ms class="text-black dark:text-gray-200" >

                    <div class="mt-2" >
                        <div class="flex items-center justify-between" >
                            <div >
                                @if(isset($meetEvent->updates[0]))
                                <p class="text-gray-500 text-xs" >Latest
                                                                  Update: {{ $meetEvent->updates->last()->created_at->diffForHumans() }}</p >
                                <p class="text-purple-500 font-semibold" >{!! $meetEvent->updates->last()->formatted !!}</p >
                                <div class="flex items-center space-x-2" >
                                    <p class="text-purple-500" >{{ $meetEvent->sections->first()->name . ' ' . $meetEvent->updates->last()->body['results_header']['heat_num'] }}</p >
                                </div >
                                @endif
                            </div >

                            <div class="flex flex-col space-y-4" >
                                @if(isset($meetEvent->updates[0]))
                                <x-primary-button @click.stop
                                                  wire:click="showEventUpdateModal({{$meetEvent->id}}, '{{$highlighted}}')"
                                                  class="rounded-md border px-1 py-1"
                                >
                                    <div class="flex items-start space-x-1 text-green-500" >
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                             viewBox="0 0 24 24"
                                             stroke="currentColor" stroke-width="2" >
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M5.636 18.364a9 9 0 010-12.728m12.728 0a9 9 0 010 12.728m-9.9-2.829a5 5 0 010-7.07m7.072 0a5 5 0 010 7.07M13 12a1 1 0 11-2 0 1 1 0 012 0z" />
                                        </svg >
                                        <p class="text-teal-500" >Event Feed</p >
                                    </div >
                                </x-primary-button >

                                @endif

                                @if($meetEvent->runnercard_event_id && $meetEvent->meet?->runnercard_meet_id)
                                <x-primary-button
                                    @click.stop
                                    @click="$dispatch('event-runnercard-modal', { runnercard_meet_id: '{{ $meetEvent->meet->runnercard_meet_id }}', runnercard_event_id: '{{ $meetEvent->runnercard_event_id }}' })"
                                    class="rounded-md border px-1 py-1"
                                >
                                    <div class="flex items-start space-x-1 text-green-500" >
                                        <p class="text-teal-500" >RunnerCard Results</p >
                                    </div >
                                </x-primary-button >
                                @endif
                            </div >
                        </div >

                        @foreach($meetEvent->sections as $section)
                            @if($section->entries->count() > 0)
                                <div class="mb-4" >
                                    <div
                                        class="font-semibold  text-gray-600 dark:text-gray-400 my-2" > {{ $section->name }} {{ $section->num . ' of ' . $section->of }}</div >
                                    <ul >
                                        @foreach($section->entries as $entry)
                                            <li class="px-2 py-1 flex items-center border-gray-300 dark:border-gray-600 first:border-t border-b border-dashed {{ (!empty($entry->school) && $entry->school === $highlighted) ? 'dark:bg-gray-700 dark:text-teal-300 bg-teal-100 font-black' : '' }}" >
                                                <div class="w-1/12" >{{ $entry->num }}</div >
                                                <div
                                                    class="w-6/12 ml-4 truncate {{ (!empty($entry->school) && $entry->school === $highlighted) ? 'font-black' : 'font-semibold' }}" >{{ $entry->name  }}</div >
                                                <div
                                                    class="w-1/12 mx-4 uppercase" >{{ $entry->grade ? $entry->grade : '' }}</div >
                                                <div
                                                    class="w-2/12 mx-4" >{{ $entry->school ? $entry->school : '' }}</div >
                                                <div class="w-2/12 mx-4  whitespace-nowrap" >{{ $entry->seed }}</div >
                                            </li >
                                        @endforeach
                                    </ul >
                                </div >
                            @endif
                        @endforeach
                    </div >
            </div >
    </li >
</div >
