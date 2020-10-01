<div>
    <section id="serie-header-section">
        <div class="container mx-auto mt-3">
            <div class="flex justify-center md:flex-row flex-wrap rounded bg-gray-2000">
                <div class="w-full md:w-1/4 p-4 text-gray-200">
                    <div class="flex justify-center md:float-right">
                        <img class="w-16 h-16 md:w-24 md:h-24 rounded-full mx-auto md:mx-0 md:mr-6 hover:opacity-75 transition transition-900 transition-ease-in bg-indigo"
                             @if($cast->poster_path)
                             src="{{ asset('storage/cast/'.$cast->poster_path)  }}"
                             @else
                             src="{{ asset('img/loader.jpg') }}"
                             @endif
                             loading="lazy"
                             alt="{{ $cast->name }}"
                        />
                    </div>
                </div>
                <div class="w-full md:w-3/4 p-4 text-center md:text-left">
                    <h2 class="text-lg text-yellow-300 font-bold mx-8">{{ $cast->name }}</h2>
                    <div class="text-gray-300 mx-8">Ka {{ count($cast->movies) }} Filma me titra shqip ne faqen tone.</div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div id="casts" class="container mx-auto my-3 bg-gray-2000 p-2 rounded">
            @if(!empty($movies))
                @include('includes.movie-greed')
            @endif
            {{ $movies->links() }}
        </div>
    </section>
    <div class="clearfix"></div>
</div>
