<div class="container mx-auto bg-gray-200 dark:bg-gray-2000 rounded-lg shadow">
    <section class="my-3 px-4 py-2 mx-auto">
        <div class="flex justify-between rounded-lg my-2 px-2 bg-blue-200 dark:bg-blue-deep">
            <h2 class="text-gray-900 dark:text-gray-100 text-xl text-center p-2">Serialet e Fundit</h2>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4 rounded-lg">
            @foreach($series as $serie)
                <div wire:loading class="border border-gray-300 shadow rounded-md p-4 max-w-sm w-full mx-auto">
                    <div class="animate-pulse flex space-x-4">
                        <div class="flex-1 space-y-4 py-1 bg-gray-800 w-full h-64">
                            <div class="h-4 bg-gray-400 rounded w-3/4"></div>
                            <div class="space-y-2">
                                <div class="h-4 bg-gray-400 rounded"></div>
                                <div class="h-4 bg-gray-400 rounded w-5/6"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div wire:loading.remove class="relative">
                    <a href="{{ route('series.show', $serie->slug) }}">
                        <img
                            class="w-full h-full rounded-lg hover:opacity-75 transition transition-900 transition-ease-in bg-yellow-900"
                            src="{{ asset('storage/serie/'.$serie->poster_path)  }}"
                            loading="lazy"
                            alt="{{ $serie->name}} me titra shqip"
                        />
                    </a>
                    <div class="absolute right-0 top-0 my-2 mx-1">
                        @if($serie->seasons)
                            <span
                                class="py-1 bg-gray-900 text-white rounded text-xs font-bold px-1"
                            >{{ count($serie->seasons) }} Sezone</span>
                        @endif
                    </div>
                    <div class="inset-x-0 absolute flex bottom-0 bg-blue-deep bg-opacity-75 hover:bg-blue-300 hover:text-gray-900 p-2 font-bold rounded-b">
                        <a href="{{ route('series.show', $serie->slug) }}" class="w-full text-sm"><h2>{{ $serie->name}}</h2></a>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
</div>
