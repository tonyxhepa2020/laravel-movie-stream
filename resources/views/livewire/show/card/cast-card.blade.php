<div wire:loading.remove class="relative">
    <a href="{{ route('casts.show', $slug) }}">
        <img
            class="w-full h-full rounded-lg hover:opacity-75 transition transition-900 transition-ease-in bg-yellow-900"
            src="{{ asset('storage/cast/'.$poster) ? asset('storage/cast/'.$poster) : asset('img/loader.jpg')  }}"
            loading="lazy"
            alt="{{ $name }}"
        />
    </a>
    @if($movies)
        <div class="absolute right-0 top-0 my-2 mx-1">
                                       <span class="py-1 bg-gray-900 text-white rounded text-xs font-bold px-1">
                                           {{ count($movies) }} Filma
                                       </span>
        </div>
    @endif
    <div class="inset-x-0 absolute flex bottom-0 bg-movie p-2 font-bold rounded-lg">
        <a href="{{ route('casts.show', $slug) }}" class="w-full text-sm">{{ $name}}</a>
    </div>
</div>
