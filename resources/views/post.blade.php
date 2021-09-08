<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Reza Nurfachmi Blog</title>
    <meta name="author" content="Reza Nurfachmi" />
    <meta name="description" content="Blog Test milik Reza Nurfachmi" />
    <meta name="keywords" content="reza, nurfachmi" />
    {{-- <link href="https://unpkg.com/tailwindcss/dist/tailwind.min.css" rel="stylesheet" /> --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!--Replace with your tailwind.css once created-->
</head>


<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <nav id="header" class="fixed w-full z-10 top-0">

        <div id="progress" class="h-1 z-20 top-0"
            style="background:linear-gradient(to right, #4dc0b5 var(--scroll), transparent 0);"></div>

        <div class="w-full md:max-w-4xl mx-auto flex flex-wrap items-center justify-between mt-0 py-3">

            <div class="pl-4">
                <a class="text-gray-900 text-base no-underline hover:no-underline font-extrabold text-xl" href="{{ route('index') }}">
                    {{ config('app.name') }}
                </a>
            </div>

            <div class="block lg:hidden pr-4">
                <button id="nav-toggle"
                    class="flex items-center px-3 py-2 border rounded text-gray-500 border-gray-600 hover:text-gray-900 hover:border-green-500 appearance-none focus:outline-none">
                    <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <title>Menu</title>
                        <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" />
                    </svg>
                </button>
            </div>

            <div class="w-full flex-grow lg:flex lg:items-center lg:w-auto hidden lg:block mt-2 lg:mt-0 bg-gray-100 md:bg-transparent z-20"
                id="nav-content">
                <ul class="list-reset lg:flex justify-end flex-1 items-center">
                    <li class="mr-3">
                        <a class="inline-block py-2 px-4 text-gray-900 font-bold no-underline" href="#">Active</a>
                    </li>
                    <li class="mr-3">
                        <a class="inline-block text-gray-600 no-underline hover:text-gray-900 hover:text-underline py-2 px-4"
                            href="#">link</a>
                    </li>
                    <li class="mr-3">
                        <a class="inline-block text-gray-600 no-underline hover:text-gray-900 hover:text-underline py-2 px-4"
                            href="#">link</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!--Container-->
    <div class="container w-full md:max-w-3xl mx-auto pt-20">

        <div class="w-full px-4 md:px-6 text-xl text-gray-800 leading-normal" style="font-family:Georgia,serif;">

            <!--Title-->
            <div class="font-sans">
                <p class="text-base md:text-sm text-green-500 font-bold">&lt; <a href="{{ route('index') }}" class="text-base md:text-sm text-green-500 font-bold no-underline hover:underline">BACK TO BLOG</a></p>
                <h1 class="font-bold font-sans break-normal text-gray-900 pt-6 pb-2 text-3xl md:text-4xl">{{ $blog->title }}</h1>
                <p class="text-sm md:text-base font-normal text-gray-600">Published on {{ $blog->created_at->format('F d, Y')}}</p>
            </div>

            <div class="object-center">
                <p class="py-6">
                    <img class="object-none object-center" src="{{ asset('storage/'. $blog->image) }}">
                </p>
            </div>

            {!! str_replace("<p>", "<p class='py-6'>", $blog->content) !!}

        </div>


        <!--Divider-->
        <hr class="border-b-2 border-gray-400 mb-8 mx-4">


        <!--Author-->
        <div class="flex w-full items-center font-sans px-4 py-12">
            <div class="flex-1 px-2">
                <p class="text-base font-bold text-base md:text-xl leading-none mb-2">Reza Nurfachmi</p>
                <p class="text-gray-600 text-xs md:text-base">Test Blog</p>
            </div>
        </div>
        <!--/Author-->

        <!--Divider-->
        <hr class="border-b-2 border-gray-400 mb-8 mx-4">

    </div>
    <!--/container-->

    <footer class="bg-white border-t border-gray-400 shadow">
        <div class="container max-w-4xl mx-auto flex py-8">

            <div class="w-full mx-auto flex flex-wrap">
                <div class="flex w-full">
                    <div class="px-8">
                        <h3 class="font-bold text-gray-900">About</h3>
                        <p class="text-gray-600 text-xs md:text-base">Minimal Blog Tailwind CSS template by <a
                                class="text-green-500 no-underline hover:underline"
                                href="https://www.tailwindtoolbox.com">TailwindToolbox.com</a></p>
                    </div>
                </div>
            </div>



        </div>
    </footer>

    <script>
        /* Progress bar */
        //Source: https://alligator.io/js/progress-bar-javascript-css-variables/
        var h = document.documentElement,
            b = document.body,
            st = 'scrollTop',
            sh = 'scrollHeight',
            progress = document.querySelector('#progress'),
            scroll;
        var scrollpos = window.scrollY;
        var header = document.getElementById("header");
        var navcontent = document.getElementById("nav-content");

        document.addEventListener('scroll', function() {

            /*Refresh scroll % width*/
            scroll = (h[st] || b[st]) / ((h[sh] || b[sh]) - h.clientHeight) * 100;
            progress.style.setProperty('--scroll', scroll + '%');

            /*Apply classes for slide in bar*/
            scrollpos = window.scrollY;

            if (scrollpos > 10) {
                header.classList.add("bg-white");
                header.classList.add("shadow");
                navcontent.classList.remove("bg-gray-100");
                navcontent.classList.add("bg-white");
            } else {
                header.classList.remove("bg-white");
                header.classList.remove("shadow");
                navcontent.classList.remove("bg-white");
                navcontent.classList.add("bg-gray-100");

            }

        });


        //Javascript to toggle the menu
        document.getElementById('nav-toggle').onclick = function() {
            document.getElementById("nav-content").classList.toggle("hidden");
        }
    </script>

</body>

</html>
