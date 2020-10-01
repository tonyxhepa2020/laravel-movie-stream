<section>
    @if(!empty($casts))
        <section class="container mx-auto my-2 bg-gray-4000 p-2 rounded shadow">
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
                @foreach($casts as $cast)
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
                        <a href="{{ route('casts.show', $cast->slug) }}">
                            <img
                                class="w-full h-full rounded hover:opacity-75 transition transition-900 transition-ease-in bg-yellow-900"
                                @if($cast->poster_path)
                                src="{{ asset('storage/cast/'.$cast->poster_path) }}"
                                @else
                                src="{{ asset('img/loader.jpg') }}"
                                @endif
                                loading="lazy"
                                alt="{{ $cast->name }}"
                            />
                        </a>
                        @if($cast->movies)
                            <div class="absolute right-0 top-0 my-2 mx-1">
                                       <span class="py-1 bg-gray-900 text-white rounded text-xs font-bold px-1">
                                           {{ count($cast->movies) }} Filma
                                       </span>
                            </div>
                        @endif
                        <div class="inset-x-0 absolute flex bottom-0 bg-movie p-2 font-bold rounded-lg">
                            <a href="{{ route('casts.show', $cast->slug) }}" class="w-full text-sm">{{ $cast->name}}</a>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-1 p-2 bg-gray-4000 text-gray-200 rounded">
                {{ $casts->onEachSide(2)->links() }}
            </div>
        </section>
        <div class="clearfix"></div>
    @endif
</section>
