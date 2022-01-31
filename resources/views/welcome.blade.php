<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Square1 Template</title>
    <meta name="author" content="Osunsami Adeolu">
    <meta name="description" content="blog page test for square1">

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <script src="https://unpkg.com/@themesberg/flowbite@1.3.0/dist/datepicker.bundle.js"></script>

    {{-- <link href="https://unpkg.com/tailwindcss/dist/tailwind.min.css" rel="stylesheet"> --}}
    <style>
        @import url('https://fonts.googleapis.com/css?family=Karla:400,700&display=swap');

        .font-family-karla {
            font-family: karla;
        }

    </style>

    <!-- AlpineJS -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"></script>
</head>

<body class="bg-white font-family-karla">

    <!-- Top Bar Nav -->
    <nav class="w-full py-4 bg-blue-800 shadow">
        <div class="w-full container mx-auto flex flex-wrap items-center justify-between">

            <nav>
                <ul class="flex items-center justify-between font-bold text-sm text-white uppercase no-underline">

                </ul>
            </nav>

            <div class="flex items-center text-lg no-underline text-white pr-6">
                @auth
                    <a class="pl-6 " href="{{ url('/home') }}">
                        <span
                            class="absolute left-0 block w-full h-0 transition-all bg-indigo-600 opacity-100 group-hover:h-full top-1/2 group-hover:top-0 duration-400 ease"></span>
                        <span
                            class="absolute right-0 flex items-center justify-start w-10 h-10 duration-300 transform translate-x-full group-hover:translate-x-0 ease">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </span>
                        <span class="relative">Dashboard </span>
                    </a>
                @else
                    <a class="pl-6 " href="{{ route('login') }}">
                        <span
                            class="absolute left-0 block w-full h-0 transition-all bg-indigo-600 opacity-100 group-hover:h-full top-1/2 group-hover:top-0 duration-400 ease"></span>
                        <span
                            class="absolute right-0 flex items-center justify-start w-10 h-10 duration-300 transform translate-x-full group-hover:translate-x-0 ease">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </span>
                        <span class="relative">Login </span>
                    </a>
                    <a class="pl-6 " href="{{ route('register') }}">
                        <span
                            class="absolute left-0 block w-full h-0 transition-all bg-indigo-600 opacity-100 group-hover:h-full top-1/2 group-hover:top-0 duration-400 ease"></span>
                        <span
                            class="absolute right-0 flex items-center justify-start w-10 h-10 duration-300 transform translate-x-full group-hover:translate-x-0 ease">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </span>
                        <span class="relative">Register </span>
                    </a>
                @endauth
            </div>
        </div>

    </nav>

    <!-- Text Header -->
    <header class="w-full container mx-auto">
        <div class="flex flex-col items-center py-12">
            <a class="font-bold text-gray-800 uppercase hover:text-gray-700 text-5xl" href="#"> Blog </a>
            <p class="text-lg text-gray-600"> Lorem Ipsum Dolor Sit Amet </p>
            <a href="#_" class="">
            </a>
        </div>
    </header>





    <div class="container mx-auto flex flex-wrap py-6">
        <form action="/" method="get">
            <div date-rangepicker="" class=" w-full flex items-center px-3">
                <div class="relative">
                    <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <input name="date_from" type="text"
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 datepicker-input"
                        placeholder="Select date start">
                </div>
                <span class="mx-4 text-gray-500"> TO </span>
                <div class="relative">
                    <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <input name="date_to" type="text"
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 datepicker-input"
                        placeholder="Select date end">
                </div>
                <button type="submit"
                    class="my-3 bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">Search
                </button>
            </div>
        </form>
    </div>
    <!-- Posts Section -->
    @foreach ($posts as $post)
        <section class="w-full md:w-3/3 flex flex-col items-center px-3">
            <!-- Each Post Content -->
            <article class="flex flex-col shadow my-4">
                <div class="bg-white flex flex-col justify-start p-6">
                    <a href="#" class="text-3xl font-bold hover:text-gray-700 pb-4"> {{ $post->title }}</a>
                    <p class="text-sm pb-3">Published on {{ $post->publication_date->format('jS F y') }} </p>
                    <a href="#" class="pb-6"> {{ $post->description }} </a>
                    <a href="#" class="uppercase text-gray-800 hover:text-black">
                        Continue Reading <i class="fas fa-arrow-right"></i></a>
                </div>
            </article>


        </section>
    @endforeach


    <footer class="w-full border-t bg-white pb-12">
        <div class="w-full container mx-auto flex flex-col items-center">
            <div class="uppercase pb-6">&copy; Square1</div>
        </div>
    </footer>
    <script src="https://unpkg.com/@themesberg/flowbite@1.3.0/dist/flowbite.bundle.js"></script>
</body>

</html>
