<div
    class="flex justify-center"
    x-data="{
        open: false,
        openModal() {
            this.open = true;
            document.documentElement.style.overflow = 'hidden';
            document.body.scroll = 'no';
        },
        closeModal() {
            this.open = false;
            document.documentElement.style.overflow = 'scroll';
            document.body.scroll = 'yes';
        },
    }"
    {{ "@".$name }}.window="openModal()"
>
    <!-- Modal -->
    <!-- dispatch $name-close-modal to close the modal -->
    <div
        x-show="open"
        {{ "@".$name."-close-modal" }}.window="closeModal()"
        style="display: none"
        x-on:keydown.escape.prevent.stop="closeModal()"
        role="dialog"
        aria-modal="true"
        x-id="['modal-title']"
        :aria-labelledby="$id('modal-title')"
        class="fixed inset-0 overflow-y-auto"
    >
        <!-- Overlay -->
        <div x-show="open" x-transition.opacity class="fixed inset-0 bg-gray-900 bg-opacity-80" ></div >

        <!-- Panel -->
        <div
            x-show="open" x-transition
            class="relative min-h-screen flex items-center justify-center p-4"
        >
            <!-- if $clickAwayClose to true allows clicking away to close the modal -->
            <div
                x-on:click.stop
                {!! $clickAwayCloses == true ? '@click.outside="closeModal()"' : '' !!}
                x-trap.noscroll.inert="open"
                class="relative max-w-2xl w-full text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-900 border rounded-lg shadow-lg py-4 overflow-y-auto"
            >
                <div class="flex items-center justify-between" >
                    <!-- Close X -->
                    <div class="block absolute top-0 right-0 pt-4 pr-4" >
                        <button @click="closeModal()" type="button"
                                class="text-gray-400 hover:text-gray-500 focus:outline-none focus:text-gray-500 transition ease-in-out duration-150"
                                aria-label="Close" >
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" >
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M6 18L18 6M6 6l12 12" />
                            </svg >
                        </button >
                    </div >
                </div >
                <div class="p-4" >
                    {{ $slot }}
                </div >
            </div >
        </div >
    </div >
</div >
