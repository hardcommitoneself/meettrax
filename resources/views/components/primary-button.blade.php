@props(['active','groupLeft','groupRight'])

@php
    $classes = ($active ?? false)
                ? 'inline-flex items-center justify-center px-2 py-[0.45rem] border border-transparent font-semibold shadow-sm text-base sm:text-sm rounded-md text-white bg-teal-500 dark:hover:bg-teal-600 hover:bg-teal-600 transition ease-in-out duration-150'
                : 'inline-flex items-center justify-center px-2 py-[0.45rem] border border-transparent font-semibold shadow-sm text-base sm:text-sm rounded-md text-teal-500 border-teal-500 bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-800 transition ease-in-out duration-150';

if (isset($groupLeft) && $groupLeft) {
    $classes .= ' rounded-r-none';
}

if (isset($groupRight) && $groupRight) {
    $classes .= ' rounded-l-none';
}

@endphp

<button {{ $attributes->merge(['type' => 'button', 'class' => $classes]) }}>
    {{ $slot }}
</button >
