<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      x-data="{ darkMode: (localStorage.getItem('dark') === 'true' || localStorage.getItem('dark') === null) } "
      x-init="$watch('darkMode', val => localStorage.setItem('dark', val))"
      x-bind:class="{ 'dark': darkMode }"
      x-cloak
>
<head >

    <meta charset="utf-8" >
    <meta name="mobile-web-app-capable" content="yes" >
    <meta name="apple-mobile-web-app-capable" content="yes" >
    <meta name="application-name" content="meettrax" >
    <meta name="apple-mobile-web-app-title" content="meettrax" >
    <meta name="msapplication-starturl" content="/" >
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" >
    <meta name="csrf-token" content="{{ csrf_token() }}" >

    <!-- Twitter -->
    <meta name="twitter:site" content="@meettrax" />
    <meta name="twitter:creator" content="@meettrax" />
    <meta name="twitter:description"
          content="track tools" />

    <title >@yield('pageTitle') / {{ config('app.name') }}</title >

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Titillium Web:400,600,700" rel="stylesheet" >

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}" >

    <!-- Favicon -->
    <link rel="apple-touch-icon" href="{{ asset('img/apple-touch-icon.png') }}" >
    <link rel="apple-touch-startup-image" href="{{ asset('apple-touch-icon.png') }}" >
    <meta name="apple-mobile-web-app-title" content="{{ config('app.name') }}" >
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/favicon-32x32.png') }}" >
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/favicon-16x16.png') }}" >
    <link rel="manifest" href="{{ asset('manifest.webmanifest') }}" >

    <!-- Alpine Plugins -->
    <script defer src="https://unpkg.com/@alpinejs/collapse@3.x.x/dist/cdn.min.js" ></script >

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer ></script >
    @livewireStyles
</head >
<body class="font-sans text-gray-900 dark:text-gray-100 dark:bg-gray-900 antialiased min-h-screen" >
<div >
    <div class="px-4 flex py-4 items-center justify-between space-x-2" >
        <div class="flex items-center space-x-2 pb-2" >
            <a href="{{ route('meets.list') }}" >
                <svg x-show="darkMode" x-cloak id="a" class="h-8" xmlns="http://www.w3.org/2000/svg"
                     viewBox="0 0 404.26 90.14" >
                    <g >
                        <path
                            d="M104.75,23.54l8.28-2.15h1.53l-.92,4.09c3.17-3.07,6.44-4.09,10.63-4.09h2.76c4.7,0,7.46,1.74,8.38,5.21,3.37-3.88,6.95-5.21,11.55-5.21h2.86c7.36,0,9.92,4.29,8.08,12.78l-8.18,38.84h-10.02l7.56-35.78c.92-4.6-.1-6.54-3.17-6.54h-3.58c-2.56,0-4.5,1.64-5.42,3.99l-8.08,38.33h-10.02l7.56-35.78c.92-4.6-.1-6.54-3.27-6.54h-3.58c-2.56,0-4.4,1.64-5.32,3.99l-8.08,38.33h-10.02l10.43-49.47Z"
                            style="fill:#fff;" />
                        <path
                            d="M178.76,63.61c2.66,0,4.09-1.64,4.91-5.21l.41-1.74h9.3l-.61,2.45c-2.25,10.94-5.62,13.9-15.33,13.9h-4.8c-10.63,0-14.82-3.07-12.57-13.8l5.52-25.25c2.35-11.24,6.54-13.19,15.84-13.19h3.88c11.45,0,15.33,1.94,12.88,13.19l-1.33,6.03c-1.84,8.69-4.09,12.47-14.31,12.47h-10.94l-1.12,5.21c-.82,3.88-.1,5.93,2.56,5.93h5.72Zm.72-33.53c-2.25,0-3.48,1.64-4.09,4.6l-1.74,8.48h10.32c1.94,0,3.17-1.23,3.78-4.09l.92-4.4c.72-3.07,.2-4.6-2.04-4.6h-7.16Z"
                            style="fill:#fff;" />
                        <path
                            d="M218.22,63.61c2.66,0,4.09-1.64,4.91-5.21l.41-1.74h9.3l-.61,2.45c-2.25,10.94-5.62,13.9-15.33,13.9h-4.8c-10.63,0-14.82-3.07-12.57-13.8l5.52-25.25c2.35-11.24,6.54-13.19,15.84-13.19h3.88c11.45,0,15.33,1.94,12.88,13.19l-1.33,6.03c-1.84,8.69-4.09,12.47-14.31,12.47h-10.94l-1.12,5.21c-.82,3.88-.1,5.93,2.56,5.93h5.72Zm.71-33.53c-2.25,0-3.48,1.64-4.09,4.6l-1.74,8.48h10.32c1.94,0,3.17-1.23,3.78-4.09l.92-4.4c.71-3.07,.2-4.6-2.04-4.6h-7.16Z"
                            style="fill:#fff;" />
                        <path
                            d="M266.16,31.41h-7.56l-5.42,25.66c-.92,4.09-.1,5.93,2.45,5.93h3.07l-1.23,10.02h-6.03c-7.87,0-10.73-4.5-8.79-13.59l5.93-28.01h-6.03l2.86-10.02h5.32l1.74-8.18,10.63-6.13h.71l-3.07,14.31h8.28l-2.86,10.02Z"
                            style="fill:#fff;" />
                        <path
                            d="M292.94,31.41h-7.56l-5.42,25.66c-.92,4.09-.1,5.93,2.45,5.93h3.07l-1.23,10.02h-6.03c-7.87,0-10.73-4.5-8.79-13.59l5.93-28.01h-6.03l2.86-10.02h5.32l1.74-8.18,10.63-6.13h.71l-3.07,14.31h8.28l-2.86,10.02Z"
                            style="fill:#fff;" />
                        <path
                            d="M312.77,33.05c-3.37,1.02-4.8,2.76-5.62,6.64l-7.05,33.32h-10.02l10.43-49.47,8.28-2.15h1.53l-1.33,6.24c1.43-2.15,3.17-3.78,5.62-4.7l9.2-3.17h.71l-1.33,9.81-10.43,3.48Z"
                            style="fill:#fff;" />
                        <path
                            d="M358.57,45.11h.1l-5.93,27.91h-8.38l.2-5.93c-2.15,3.99-5.21,5.93-10.73,5.93h-4.7c-7.36,0-10.02-4.4-8.28-12.88l5.32-24.94c2.04-9.51,6.75-14.41,14.72-14.41h4.7c4.19,0,6.13,1.12,7.16,4.19l.82-3.58h10.02l-5.01,23.71Zm-7.97-9.81c.2-3.17-.92-4.8-3.48-4.8h-5.42c-2.96,0-4.91,1.84-5.83,6.44l-4.29,19.93c-.92,4.6,.2,6.44,3.17,6.44h5.42c2.66,0,4.7-1.84,5.83-5.83l.92-4.4h-.1l3.78-17.79Z"
                            style="fill:#fff;" />
                        <path
                            d="M393.22,21.39h11.04l-15.03,25.96,3.99,25.66h-10.53l-2.86-19.52-11.04,19.52h-11.04l14.72-25.66-3.99-25.96h10.63l2.55,21.06,11.55-21.06Z"
                            style="fill:#fff;" />
                    </g >
                    <g >
                        <line x1="47.35" y1="85.39" x2="64.11" y2="68.63" style="fill:#231f20;" />
                        <path
                            d="M50.53,88.57l16.76-16.76c4.1-4.1-2.26-10.47-6.36-6.36l-16.76,16.76c-4.1,4.1,2.26,10.47,6.36,6.36h0Z"
                            style="fill:#14b7a5;" />
                    </g >
                    <g >
                        <line x1="43.46" y1="48.2" x2="63.84" y2="68.57" style="fill:#231f20;" />
                        <path
                            d="M40.28,51.38l20.37,20.37c4.1,4.1,10.47-2.26,6.36-6.36l-20.37-20.37c-4.1-4.1-10.47,2.26-6.36,6.36h0Z"
                            style="fill:#14b7a5;" />
                    </g >
                    <g >
                        <g >
                            <line x1="27.97" y1="38.12" x2="44.26" y2="21.83" style="fill:#3a3a3a;" />
                            <path
                                d="M31.15,41.3l16.29-16.29c4.1-4.1-2.26-10.47-6.36-6.36l-16.29,16.29c-4.1,4.1,2.26,10.47,6.36,6.36h0Z"
                                style="fill:#00b6d3;" />
                        </g >
                        <g >
                            <line x1="64" y1="42.18" x2="80.29" y2="25.89" style="fill:#3a3a3a;" />
                            <path
                                d="M67.18,45.36l16.29-16.29c4.1-4.1-2.26-10.47-6.36-6.36l-16.29,16.29c-4.1,4.1,2.26,10.47,6.36,6.36h0Z"
                                style="fill:#00b6d3;" />
                        </g >
                        <g >
                            <line x1="43.94" y1="21.83" x2="64.31" y2="42.2" style="fill:#3a3a3a;" />
                            <path
                                d="M40.75,25.01l20.37,20.37c4.1,4.1,10.47-2.26,6.36-6.36l-20.37-20.37c-4.1-4.1-10.47,2.26-6.36,6.36h0Z"
                                style="fill:#00b6d3;" />
                        </g >
                    </g >
                    <circle cx="62.73" cy="9" r="9" style="fill:#14b7a5;" />
                    <g >
                        <line x1="4.51" y1="85.63" x2="29.55" y2="60.59" style="fill:#231f20;" />
                        <path
                            d="M7.69,88.81l25.04-25.04c4.1-4.1-2.26-10.47-6.36-6.36L1.32,82.45c-4.1,4.1,2.26,10.47,6.36,6.36h0Z"
                            style="fill:#14b7a5;" />
                    </g >
                </svg >
                <svg x-show="!darkMode" x-cloak id="a" class="h-8" xmlns="http://www.w3.org/2000/svg"
                     viewBox="0 0 404.26 90.14" >
                    <defs >
                        <style >.b {
                                fill: #00b6d3;
                            }

                            .c {
                                fill: #14b7a5;
                            }

                            .d {
                                fill: #231f20;
                            }

                            .e {
                                fill: #3a3a3a;
                            }</style >
                    </defs >
                    <g >
                        <path class="e"
                              d="M104.75,23.54l8.28-2.15h1.53l-.92,4.09c3.17-3.07,6.44-4.09,10.63-4.09h2.76c4.7,0,7.46,1.74,8.38,5.21,3.37-3.88,6.95-5.21,11.55-5.21h2.86c7.36,0,9.92,4.29,8.08,12.78l-8.18,38.84h-10.02l7.56-35.78c.92-4.6-.1-6.54-3.17-6.54h-3.58c-2.56,0-4.5,1.64-5.42,3.99l-8.08,38.33h-10.02l7.56-35.78c.92-4.6-.1-6.54-3.27-6.54h-3.58c-2.56,0-4.4,1.64-5.32,3.99l-8.08,38.33h-10.02l10.43-49.47Z" />
                        <path class="e"
                              d="M178.76,63.61c2.66,0,4.09-1.64,4.91-5.21l.41-1.74h9.3l-.61,2.45c-2.25,10.94-5.62,13.9-15.33,13.9h-4.8c-10.63,0-14.82-3.07-12.57-13.8l5.52-25.25c2.35-11.24,6.54-13.19,15.84-13.19h3.88c11.45,0,15.33,1.94,12.88,13.19l-1.33,6.03c-1.84,8.69-4.09,12.47-14.31,12.47h-10.94l-1.12,5.21c-.82,3.88-.1,5.93,2.56,5.93h5.72Zm.72-33.53c-2.25,0-3.48,1.64-4.09,4.6l-1.74,8.48h10.32c1.94,0,3.17-1.23,3.78-4.09l.92-4.4c.72-3.07,.2-4.6-2.04-4.6h-7.16Z" />
                        <path class="e"
                              d="M218.22,63.61c2.66,0,4.09-1.64,4.91-5.21l.41-1.74h9.3l-.61,2.45c-2.25,10.94-5.62,13.9-15.33,13.9h-4.8c-10.63,0-14.82-3.07-12.57-13.8l5.52-25.25c2.35-11.24,6.54-13.19,15.84-13.19h3.88c11.45,0,15.33,1.94,12.88,13.19l-1.33,6.03c-1.84,8.69-4.09,12.47-14.31,12.47h-10.94l-1.12,5.21c-.82,3.88-.1,5.93,2.56,5.93h5.72Zm.71-33.53c-2.25,0-3.48,1.64-4.09,4.6l-1.74,8.48h10.32c1.94,0,3.17-1.23,3.78-4.09l.92-4.4c.71-3.07,.2-4.6-2.04-4.6h-7.16Z" />
                        <path class="e"
                              d="M266.16,31.41h-7.56l-5.42,25.66c-.92,4.09-.1,5.93,2.45,5.93h3.07l-1.23,10.02h-6.03c-7.87,0-10.73-4.5-8.79-13.59l5.93-28.01h-6.03l2.86-10.02h5.32l1.74-8.18,10.63-6.13h.71l-3.07,14.31h8.28l-2.86,10.02Z" />
                        <path class="e"
                              d="M292.94,31.41h-7.56l-5.42,25.66c-.92,4.09-.1,5.93,2.45,5.93h3.07l-1.23,10.02h-6.03c-7.87,0-10.73-4.5-8.79-13.59l5.93-28.01h-6.03l2.86-10.02h5.32l1.74-8.18,10.63-6.13h.71l-3.07,14.31h8.28l-2.86,10.02Z" />
                        <path class="e"
                              d="M312.77,33.05c-3.37,1.02-4.8,2.76-5.62,6.64l-7.05,33.32h-10.02l10.43-49.47,8.28-2.15h1.53l-1.33,6.24c1.43-2.15,3.17-3.78,5.62-4.7l9.2-3.17h.71l-1.33,9.81-10.43,3.48Z" />
                        <path class="e"
                              d="M358.57,45.11h.1l-5.93,27.91h-8.38l.2-5.93c-2.15,3.99-5.21,5.93-10.73,5.93h-4.7c-7.36,0-10.02-4.4-8.28-12.88l5.32-24.94c2.04-9.51,6.75-14.41,14.72-14.41h4.7c4.19,0,6.13,1.12,7.16,4.19l.82-3.58h10.02l-5.01,23.71Zm-7.97-9.81c.2-3.17-.92-4.8-3.48-4.8h-5.42c-2.96,0-4.91,1.84-5.83,6.44l-4.29,19.93c-.92,4.6,.2,6.44,3.17,6.44h5.42c2.66,0,4.7-1.84,5.83-5.83l.92-4.4h-.1l3.78-17.79Z" />
                        <path class="e"
                              d="M393.22,21.39h11.04l-15.03,25.96,3.99,25.66h-10.53l-2.86-19.52-11.04,19.52h-11.04l14.72-25.66-3.99-25.96h10.63l2.55,21.06,11.55-21.06Z" />
                    </g >
                    <g >
                        <line class="d" x1="47.35" y1="85.39" x2="64.11" y2="68.63" />
                        <path class="c"
                              d="M50.53,88.57l16.76-16.76c4.1-4.1-2.26-10.47-6.36-6.36l-16.76,16.76c-4.1,4.1,2.26,10.47,6.36,6.36h0Z" />
                    </g >
                    <g >
                        <line class="d" x1="43.46" y1="48.2" x2="63.84" y2="68.57" />
                        <path class="c"
                              d="M40.28,51.38l20.37,20.37c4.1,4.1,10.47-2.26,6.36-6.36l-20.37-20.37c-4.1-4.1-10.47,2.26-6.36,6.36h0Z" />
                    </g >
                    <g >
                        <g >
                            <line class="e" x1="27.97" y1="38.12" x2="44.26" y2="21.83" />
                            <path class="b"
                                  d="M31.15,41.3l16.29-16.29c4.1-4.1-2.26-10.47-6.36-6.36l-16.29,16.29c-4.1,4.1,2.26,10.47,6.36,6.36h0Z" />
                        </g >
                        <g >
                            <line class="e" x1="64" y1="42.18" x2="80.29" y2="25.89" />
                            <path class="b"
                                  d="M67.18,45.36l16.29-16.29c4.1-4.1-2.26-10.47-6.36-6.36l-16.29,16.29c-4.1,4.1,2.26,10.47,6.36,6.36h0Z" />
                        </g >
                        <g >
                            <line class="e" x1="43.94" y1="21.83" x2="64.31" y2="42.2" />
                            <path class="b"
                                  d="M40.75,25.01l20.37,20.37c4.1,4.1,10.47-2.26,6.36-6.36l-20.37-20.37c-4.1-4.1-10.47,2.26-6.36,6.36h0Z" />
                        </g >
                    </g >
                    <circle class="c" cx="62.73" cy="9" r="9" />
                    <g >
                        <line class="d" x1="4.51" y1="85.63" x2="29.55" y2="60.59" />
                        <path class="c"
                              d="M7.69,88.81l25.04-25.04c4.1-4.1-2.26-10.47-6.36-6.36L1.32,82.45c-4.1,4.1,2.26,10.47,6.36,6.36h0Z" />
                    </g >
                </svg >
            </a >
            <div class="text-xs font-semibold text-teal-500 italic" >[beta]</div >
        </div >
        <button @click="darkMode = !darkMode" >
            <svg x-show="!darkMode" x-cloak xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-sun"
                 width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                 stroke-linecap="round" stroke-linejoin="round" >
                <path stroke="none" d="M0 0h24v24H0z" fill="none" ></path >
                <circle cx="12" cy="12" r="4" ></circle >
                <path
                    d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7" ></path >
            </svg >
            <svg x-show="darkMode" x-cloak style="width:24px;height:24px" viewBox="0 0 24 24" >
                <path fill="currentColor"
                      d="M17.75,4.09L15.22,6.03L16.13,9.09L13.5,7.28L10.87,9.09L11.78,6.03L9.25,4.09L12.44,4L13.5,1L14.56,4L17.75,4.09M21.25,11L19.61,12.25L20.2,14.23L18.5,13.06L16.8,14.23L17.39,12.25L15.75,11L17.81,10.95L18.5,9L19.19,10.95L21.25,11M18.97,15.95C19.8,15.87 20.69,17.05 20.16,17.8C19.84,18.25 19.5,18.67 19.08,19.07C15.17,23 8.84,23 4.94,19.07C1.03,15.17 1.03,8.83 4.94,4.93C5.34,4.53 5.76,4.17 6.21,3.85C6.96,3.32 8.14,4.21 8.06,5.04C7.79,7.9 8.75,10.87 10.95,13.06C13.14,15.26 16.1,16.22 18.97,15.95M17.33,17.97C14.5,17.81 11.7,16.64 9.53,14.5C7.36,12.31 6.2,9.5 6.04,6.68C3.23,9.82 3.34,14.64 6.35,17.66C9.37,20.67 14.19,20.78 17.33,17.97Z" ></path >
            </svg >
        </button >

    </div >
    {{ $slot }}
    <div class="flex items-center justify-center pb-2 space-x-2 dark:text-gray-600 text-gray-400" >
        <p class="flex items-baseline uppercase" >B<span class="text-xs pr-1" >y</span > J<span
                class="text-xs mr-1" >eff</span >H
            <span
                class="text-xs" >ansen</span ></p >
        <a href="mailto:jhansen@hivalley.com" >
            <p class="text-xs uppercase text-teal-500" >@ Email</p >
        </a >
    </div >
    <div class="text-xs uppercase italic flex items-center justify-center mb-8 dark:text-gray-600 text-gray-400" >
        run fast, jump long, vault high
    </div >
</div >
@livewireScripts
</body >
</html >