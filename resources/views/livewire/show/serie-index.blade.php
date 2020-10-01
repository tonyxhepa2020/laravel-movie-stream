<div>
    <div id="search" class="container mx-auto my-3">
        <div class="clearfix"></div>
        @if(!empty($series))
            <div class="container bg-gray-2000 p-4 mx-auto rounded my-3">
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4 rounded">
                    @foreach($series as $serie)
                        <div class="relative">
                            <a href="{{ route('series.show', $serie->slug) }}">
                                <img
                                    class="lazyload w-full h-full rounded hover:opacity-75 transition transition-900 transition-ease-in bg-yellow-900"
                                    @if($serie->poster_path))
                                    src="{{ asset('storage/serie/'.$serie->poster_path)  }}"
                                    @else
                                    src="{{ asset('img/loader.jpg') }}"
                                    @endif
                                    alt="{{ $serie->name}} me titra shqip"
                                    loading="lazy"
                                />
                            </a>
                            @if($serie->seasons)
                                <div class="absolute right-0 top-0 my-2 mx-1">
                        <span class="py-1 bg-gray-900 text-white rounded text-xs font-bold px-1">
                            {{ count($serie->seasons) }} Sezone
                        </span>
                                </div>
                            @endif
                            <div class="inset-x-0 absolute flex bottom-0 bg-movie p-2 font-bold rounded-b bg-blue-deep">
                                <a href="{{ route('series.show', $serie->slug) }}" class="w-full text-sm"><h2>{{ $serie->name}}</h2></a>
                            </div>
                        </div>
                    @endforeach
                </div>
               <div class="mt-2 p-2 bg-gray-4000 text-gray-200 rounded">
                   {{ $series->links() }}
               </div>
            </div>
        @endif
    </div>
    <div class="clearfix"></div>
</div>
