<div>
    <section id="serie-header-section">
        <div class="container mx-auto mt-3">
            <div class="flex justify-center md:flex-row flex-wrap rounded bg-gray-2000">
                <div class="w-full md:w-1/4 p-4 text-gray-200">
                    <div class="flex justify-center md:float-right">
                        <img class="w-16 h-16 md:w-24 md:h-24 rounded-full mx-auto md:mx-0 md:mr-6 hover:opacity-75 transition transition-900 transition-ease-in bg-indigo"
                             @if($serie->poster_path)
                             src="{{ asset('storage/serie/'.$serie->poster_path)  }}"
                             @else
                             src="{{ asset('img/loader.jpg') }}"
                             @endif
                             alt="{{ $serie->name}} me titra shqip"
                             loading="lazy"
                        />
                    </div>
                </div>
                <div class="w-full md:w-3/4 p-4 text-center md:text-left">
                    <h1 class="text-lg text-blue-deep font-bold mx-8">{{ $serie->name }} me titra shqip.</h1>
                    <div class="text-blue-600 mx-8">Ky serial ka {{ count($serie->seasons) }} Sezone.</div>
                    <p hidden>{{ $serie->name }} me Titra Shqip filma24.pw, Shiko dhe shkarko filma me titra shqip.</p>
                </div>
            </div>
        </div>
    </section>
    <div class="clearfix"></div>
    @if(!empty($seasons))
        <div class="container bg-gray-2000 p-4 mx-auto rounded my-3">
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4 rounded">
                @foreach($seasons as $season)
                    <div class="relative">
                        <a href="{{ route('seasons.show', [$serie->slug, $season->slug]) }}">
                            <img
                                class="w-full h-full rounded hover:opacity-75 transition transition-900 transition-ease-in bg-yellow-900"
                                @if($season->poster_path)
                                src="{{ asset('storage/serie/season/'.$season->poster_path)  }}"
                                @else
                                src="{{ asset('img/loader.jpg') }}"
                                @endif
                                alt="{{ $season->season_number }} me titra shqip"
                                loading="lazy"
                            />
                        </a>
                        @if($season->episodes)
                            <div class="absolute right-0 top-0 my-2 mx-1">
                        <span class="py-1 bg-gray-900 text-white rounded text-xs font-bold px-1">
                            {{ count($season->episodes) }} Episode
                        </span>
                            </div>
                        @endif
                        <div class="inset-x-0 absolute flex bottom-0 bg-movie p-2 font-bold rounded-b bg-blue-deep">
                            <a href="{{ route('seasons.show', [$serie->slug, $season->slug]) }}" class="w-full text-sm"><h2>{{ $season->name}}</h2></a>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-2 p-2 bg-gray-4000 text-gray-200 rounded">
                {{ $seasons->links() }}
            </div>
        </div>
    @endif
    <div class="clearfix"></div>
</div>
