@extends('layouts.show')

@section('content')
    <main class="container mx-auto bg-gray-200 dark:bg-gray-4000 p-2 rounded-lg my-2">
        <div class="clearfix"></div>
        @if(!empty($movie))
            @if(!empty($movie->embeds))
                <section
                    id="embed"
                    class="container mx-auto rounded-lg mt-2"
                >
                    <h2 class="text-green-700" hidden>Shiko {{ $movie->title }} me titra shqip</h2>
                    @foreach($movie->trailers->merge($movie->embeds) as $count => $embed)
                        <div id="{{ $embed->id }}" class="flex justify-around city hidden">
                            <div class="iframe-container bg-black">
                                <iframe
                                    class="lazyload rounded-lg"
                                    ref="frame"
                                    src="{{ $embed->web_url }}"
                                    frameborder="0"
                                    allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen
                                    loading="lazy"
                                ></iframe>
                            </div>
                        </div>
                    @endforeach
                    <div class="flex flex-wrap bg-blue-300 dark:bg-gray-4000 mt-2 rounded">
                        @foreach($movie->trailers->merge($movie->embeds) as $count => $embed)
                            <button
                                @if ($loop->first) id="default" @endif
                            class="p-1 lg:p-2 m-1 md:m-2 lg:m-2
                            focus:outline-none focus:bg-blue-deep dark:focus:bg-blue-deep dark:bg-gray-2000 dark:text-gray-200 hover:bg-gray-3000
                            font-bold hover:text-gray-500 rounded shadow tablink"
                                onclick="openEmbed(event,'{{ $embed->id }}')">{{ $embed->web_name }}</button>
                        @endforeach
                    </div>
                    <script>
                        function openEmbed(evt, cityName) {
                            var i, x, tablinks;
                            x = document.getElementsByClassName("city");
                            for (i = 0; i < x.length; i++) {
                                x[i].style.display = "none";
                            }
                            tablinks = document.getElementsByClassName("tablink");
                            for (i = 0; i < x.length; i++) {
                                tablinks[i].className = tablinks[i].className.replace(" bg-blue-deed", "");
                            }
                            document.getElementById(cityName).style.display = "block";
                            evt.currentTarget.className += " bg-blue-deed";
                        }
                        document.getElementById("default").click();
                    </script>
                </section>
            @endif
            <section class="container mx-auto bg-gray-200 dark:bg-gray-2000 rounded m-2">
                <div class="grid grid-cols-12">
                    <div class="col-span-12 md:col-span-8 lg:col-span-8">
                        <div class="flex p-2 bg-gray-200 dark:bg-gray-4000 m-2 rounded">
                            <div class="w-3/12">
                                <div class="w-full">
                                    <img
                                        class="w-full h-full rounded hover:opacity-75 transition transition-900 transition-ease-in bg-yellow-900"
                                        src="{{ asset('storage/movie/'.$movie->poster_path)  }}"
                                        loading="lazy"
                                        alt="{{ $movie->title}} me titra shqip"
                                    />
                                </div>
                            </div>
                            <div class="w-8/12 ml-2">
                                <h1 class="flex text-white font-bold text-center"><div class="w-full text-center">{{ $movie->title }} me titra shqip</div> </h1>
                                <div class="flex justify-around md:text-lg p-3 text-gray-600">
                                    <div class="flex-1 ml-1">
                                        <span class="text-white md:font-bold">
                                            {{ $movie->video_format }}
                                        </span>
                                    </div>
                                    <div class="flex-1 ml-1">
                                        <div class="flex items-center">
                                            <svg class="fill-current mr-1 md:mr-2 lg:mr-2 text-yellow-500 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path d="M10 20a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm-1-7.59V4h2v5.59l3.95 3.95-1.41 1.41L9 10.41z"/>
                                            </svg>
                                            <span class="md:font-bold text-white">{{ $movie->runtime }}</span>
                                        </div>
                                    </div>
                                    <div class="flex-1 ml-1">
                                        <div class="flex items-center">
                                            <svg class="fill-current mr-1 md:mr-2 lg:mr-2 text-yellow-500 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path d="M15 2h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4c0-1.1.9-2 2-2h2V0h2v2h6V0h2v2zM3 6v12h14V6H3zm6 5V9h2v2h2v2h-2v2H9v-2H7v-2h2z"/>
                                            </svg>
                                            <span class="md:font-bold text-white">{{ date('Y', strtotime($movie->release_date)) }}</span>
                                        </div>
                                    </div>
                                    <div class="flex-1 ml-1">
                                        <div class="flex items-center">
                                            <svg class="fill-current mr-1 md:mr-2 lg:mr-2 text-yellow-500 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                 viewBox="0 0 20 20">
                                                <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                            </svg><span class="md:font-bold text-white">{{ $movie->rating }}</span>
                                        </div>
                                    </div>
                                </div>
                                @if(!empty($movie->genres))
                                    <div class="flex flex-wrap">
                                        @foreach($movie->genres as $genre)
                                            <a class="h-10 p-1 mx-2 text-yellow-700 text-center" href="{{ route('genres.show', $genre->slug) }}">
                                                {{ $genre->title }}
                                            </a>
                                        @endforeach
                                    </div>
                                @endif
                                <div class="w-full hidden md:block lg:block text-sm text-white p-3">
                                    <p hidden>{{ $movie->title }} me titra shqip filma24.pw</p>
                                    <p>{{ $movie->overview }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="flex p-2 lg:hidden lg:hidden bg-black m-2 rounded-lg text-sm text-white p-3">
                            <p>{{ $movie->overview }}</p>
                        </div>
                        <div class="m-2 p-2 bg-gray-200 dark:bg-gray-4000 rounded">
                            @if(!empty($movie->casts))
                                <div class="grid grid-cols-3 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
                                    @foreach($movie->casts as $cast)
                                        <div class="relative">
                                            <a href="{{ route('casts.show', $cast->slug) }}">
                                                <img
                                                    class="w-full h-full rounded hover:opacity-75 transition transition-900 transition-ease-in bg-yellow-900"
                                                    src="{{ asset('storage/cast/'.$cast->poster_path)  }}"
                                                    loading="lazy"
                                                    alt="{{ $cast->name}}"
                                                />
                                                <noscript>
                                                    <img
                                                        class="lazy w-full h-full rounded-lg hover:opacity-75 transition transition-900 transition-ease-in bg-yellow-900"
                                                        src="{{ asset('storage/cast/'.$cast->poster_path)  }}"
                                                        alt="filma me titra shqip"
                                                    />
                                                </noscript>
                                            </a>
                                            <div class="inset-x-0 absolute flex bottom-0 bg-movie p-2 font-bold rounded-lg">
                                                <a href="{{ route('casts.show', $cast->slug) }}" class="w-full text-sm"><h2>{{ $cast->name}}</h2></a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>

                        <div class="container mx-auto p-2 m-2">
                            @if(!empty($movie->watchs))
                                <div class="bg-gray-200 dark:bg-gray-4000 my-2 py-2 rounded">
                                    <h3 class="text-lg text-gray-300 p-2 rounded">Shikoje {{ $movie->title }} ne hoste te tjere</h3>
                                    <div class="flex flex-wrap">
                                        @foreach($movie->watchs as $watch)
                                            <a href="{{ $watch->web_url }}" target="_blank">
                                                <div
                                                    class="h-18 ml-1 p-2 hover:bg-blue-700 text-gray-300 hover:text-gray-500 rounded border border-blue-500 transition-bg transition-500 transition-ease-in">
                                                    {{ $watch->web_name }}</div>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                            @if(!empty($movie->downloads))
                                <div class="bg-gray-200 dark:bg-gray-4000 my-2 py-2 rounded">
                                    <h3 class="text-lg text-gray-300 p-2 rounded-lg">Shkarko {{ $movie->title }} ne hoste te tjere</h3>
                                    <div class="flex flex-wrap">
                                        @foreach($movie->downloads as $download)
                                            <a href="{{ $download->web_url }}" target="_blank">
                                                <div
                                                    class="flex mt-1 h-18 ml-1 p-2 hover:bg-blue-700 text-gray-300 hover:text-gray-500 rounded border border-blue-500 transition-bg transition-500 transition-ease-in">
                                                    <svg class="fill-current w-4 h-4 mr-2 text-blue-deep" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M13 8V2H7v6H2l8 8 8-8h-5zM0 18h20v2H0v-2z"/></svg>
                                                    {{ $download->web_name }}
                                                </div>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-4 lg:col-span-4 p-2 mx-2 bg-gray-200 mt-2 dark:bg-gray-4000">
                        <div class="w-full p-2 text-yellow-700">Te Rekomanduar</div>
                        @if(!empty($latest))
                            <div class="grid grid-cols-3 gap-2 md:gap-4 lg:gap-4">
                                @foreach($latest as $l)
                                    <a href="{{ route('movies.show', $l->slug) }}">
                                        <img
                                            class="w-full h-full rounded-lg hover:opacity-75 transition transition-900 transition-ease-in bg-yellow-900"
                                            src="{{ asset('storage/movie/'.$l->poster_path)  }}"
                                            loading="lazy"
                                            alt="{{ $l->title}} me titra shqip"
                                        />
                                        <h2 hidden>{{ $l->title }}</h2>
                                        <p hidden>{{ $l->overview }}</p>
                                    </a>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </section>
            <section>
                @if(!empty($movie->tags))
                    <div class="container mx-auto m-2">
                        <div class="flex flex-wrap bg-blue-deep rounded">
                            @foreach($movie->tags as $tag)
                                <a class="p-2 text-sm font-bold hover:text-gray-900" href="{{ route('tags.show', $tag->slug) }}">#{{$tag->tag_name}}</a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </section>
            <div class="clearfix"></div>
        @endif
    </main>
@endsection
