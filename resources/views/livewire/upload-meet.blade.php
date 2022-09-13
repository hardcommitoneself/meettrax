<div class="pb-4 px-4" >
    <div class="flex items-center" >
        <div class="pr-1 pb-2" >
            <a href="{{ route('meets.list') }}" >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor" stroke-width="2" >
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg >
            </a >
        </div >
        <h1 class="text-xl pb-2 font-semibold truncate" >Upload a meet program</h1 >
    </div >
    <p >The file must be a meet program PDF generated directly from RunnerCard.</p >

    <form wire:submit.prevent="save" >
        <div class="flex justify-center" >
            <div wire:loading.delay class="py-8" >
                <svg class="animate-spin -ml-1 mr-3 h-24 w-24 text-gray-800 dark:text-white"
                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" >
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" ></circle >
                    <path class="opacity-75" fill="currentColor"
                          d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z" ></path >
                </svg >
            </div >
        </div >

        <div wire:loading.remove >

            <div class="mt-4" >
                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border border-gray-300 border-dashed rounded-md" >
                    <div class="space-y-1 text-center" >
                        <svg class="mb-4 mx-auto h-12 w-12 text-gray-400" stroke="none" fill="currentColor"
                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" >
                            <path
                                d="M88 304H80V256H88C101.3 256 112 266.7 112 280C112 293.3 101.3 304 88 304zM192 256H200C208.8 256 216 263.2 216 272V336C216 344.8 208.8 352 200 352H192V256zM224 0V128C224 145.7 238.3 160 256 160H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64C0 28.65 28.65 0 64 0H224zM64 224C55.16 224 48 231.2 48 240V368C48 376.8 55.16 384 64 384C72.84 384 80 376.8 80 368V336H88C118.9 336 144 310.9 144 280C144 249.1 118.9 224 88 224H64zM160 368C160 376.8 167.2 384 176 384H200C226.5 384 248 362.5 248 336V272C248 245.5 226.5 224 200 224H176C167.2 224 160 231.2 160 240V368zM288 224C279.2 224 272 231.2 272 240V368C272 376.8 279.2 384 288 384C296.8 384 304 376.8 304 368V320H336C344.8 320 352 312.8 352 304C352 295.2 344.8 288 336 288H304V256H336C344.8 256 352 248.8 352 240C352 231.2 344.8 224 336 224H288zM256 0L384 128H256V0z" />
                        </svg >

                        <div class="flex text-sm text-gray-600" >
                            <label for="file-upload"
                                   class="relative cursor-pointer dark:bg-gray-900 bg-white rounded-md font-medium text-teal-600 hover:text-teal-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-teal-500" >
                                <input wire:model="file" id="file-upload" name="file-upload" type="file"
                                >
                            </label >
                        </div >
                        <p class="text-xs text-gray-500" >RunnerCard Program PDF up to 1MB</p >
                        @error('file') <span class="text-red-500 font-semibold py-1" >
                            {{ $message }}
                        </span > @enderror

                        @if (session()->has('error'))
                            <span class="text-red-500 font-semibold py-1" >
                                {{ session('error') }}
                            </span >
                        @endif

                    </div >
                </div >
            </div >

            @if($file)
                <div class="mt-8" >
                    <x-primary-button class="w-full" type="submit" >Upload Program</x-primary-button >
                </div >
            @endif
        </div >

    </form >
</div >
