<div class="dark:text-gray-400 flex flex-wrap items-center space-x-1 text-xs" >
    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-cyan-500" fill="none" viewBox="0 0 24 24"
         stroke="currentColor" stroke-width="2" >
        <path stroke-linecap="round" stroke-linejoin="round"
              d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" />
    </svg >
    <p >Schools
        <x-count-badge >{{ $countSchools }}</x-count-badge >
    </p >
    <p >Athletes
        <x-count-badge >{{ $countAthletes }}</x-count-badge >
    </p >
    <p >Entries
        <x-count-badge >{{ $countEntries }}</x-count-badge >
    </p >
</div >
