<div>
    <section id="serie-header-section">
        <div class="container mx-auto mt-3">
            <div class="flex justify-center md:flex-row flex-wrap rounded bg-gray-2000">
                <div class="w-full md:w-1/4 p-4 text-gray-200">
                    <div class="flex justify-center md:float-right">
                        <img class="lazyload w-16 h-16 md:w-24 md:h-24 rounded-full mx-auto md:mx-0 md:mr-6 hover:opacity-75 transition transition-900 transition-ease-in bg-indigo"
                             @if($season->poster_path)
                             src="{{ asset('storage/serie/season/'.$season->poster_path)  }}"
                             @else
                             src="{{ asset('img/loader.jpg') }}"
                             @endif
                             alt="{{ $season->season_number }} me titra shqip"
                             loading="lazy"
                             alt="{{ $serie->name }} sezoni {{ $season->season_number }} me Titra Shqip"
                        />
                    </div>
                </div>
                <div class="w-full md:w-3/4 p-4 text-center md:text-left">
                    <h1 class="text-lg text-blue-deep font-bold mx-8">{{ $serie->name }} sezoni {{ $season->season_number }} me titra shqip.</h1>
                    <div class="text-blue-600 mx-8">Ky sezon ka {{ count($season->episodes) }} Episode.</div>
                </div>
            </div>
        </div>
    </section>
    <div class="clearfix"></div>
    @if(!empty($episodes))
        <div class="container bg-gray-2000 p-4 mx-auto rounded my-3">
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4 rounded">
                @foreach($episodes as $episode)
                    <div class="relative  hover:text-gray-900 hover:opacity-75 transition duration-500 ease-in-out">
                        <a href="{{ route('episodes.show', $episode->slug) }}">
                            <img
                                class="lazyload w-full h-full rounded-lg hover:opacity-75 transition transition-900 transition-ease-in bg-yellow-900"
                                @if($season->poster_path)
                                src="{{ asset('storage/serie/season/'.$season->poster_path)  }}"
                                @else
                                src="{{ asset('img/loader.jpg') }}"
                                @endif
                                alt="{{ $season->season_number }} me titra shqip"
                                loading="lazy"
                                alt="{{ $episode->name }}"
                            />
                        </a>
                        <div class="inset-x-0 absolute flex bottom-0 bg-movie p-2 font-bold rounded-b bg-blue-deep">
                            <a href="{{ route('episodes.show', $episode->slug) }}" class="w-full text-sm"><h2>{{ $episode->name}}</h2></a>
                        </div>
                    </div>
                @endforeach
            </div>
            {{ $episodes->links() }}
        </div>
    @endif
</div>
