<div>
    <section>
        @if(!empty($episode))
            <div id="episode" class="container mx-auto my-3 bg-gray-4000 text-gray-200 rounded">
                <div class="flex flex-wrap">
                    <div class="w-full md:w-3/4 px-3">
                        {{-- embeds start --}}
                        @if(!empty($episode->embeds))
                           @include('includes.episode_iframe')
                        @endif
                        {{-- embeds end --}}

                        {{-- episode title start --}}
                        <div class="flex justify-center bg-gray-3000 text-gray-300 mt-3 p-3 rounded text-center text-lg">
                            {{ $season->serie->name }} - Episodi {{ $episode->episode_number }}
                        </div>
                        {{-- episodes list start --}}
                        <div class="flex flex-wrap my-3 rounded bg-gray-3000 p-2">
                            @foreach($season->episodes as $ep)
                                @if($episode->id == $ep->id)
                                    <div class="w-1/2 md:w-1/4 p-2">
                                        <a href="#"
                                           class="w-full p-2 text-center m-2 text-white rounded bg-blue-deep hover:bg-gray-2000 hover:text-white transition-bg transition-500 transition-ease-in">
                                            Episodi {{ $ep->episode_number }}</a>
                                    </div>
                                @else
                                <div class="w-1/2 md:w-1/4 p-2">
                                    <a href="{{ route('episodes.show', $ep->slug) }}"
                                       class="w-full p-2 text-center m-2 text-white rounded bg-gray-4000 hover:bg-gray-2000 hover:text-gray-200 transition-bg transition-500 transition-ease-in">
                                        Episodi {{ $ep->episode_number }}</a>
                                </div>
                                @endif
                            @endforeach
                        </div>
                        {{-- episode list ends --}}
                        <div class="container mx-auto">
                            @if(!empty($episode->watchs))
                                <div class="text-gray-200 bg-gray-3000 my-3 p-2 rounded">
                                    <h3 class="text-lg p-2 rounded">Shikoje ne hoste te tjere</h3>
                                    <div class="flex flex-wrap">
                                        @foreach($episode->watchs as $watch)
                                            <a href="{{ $watch->web_url }}" target="_blank">
                                                <div
                                                    class="flex mt-1 h-18 ml-1 p-2 hover:bg-blue-700 hover:text-gray-500 rounded border border-blue-500 transition-bg transition-500 transition-ease-in">
                                                    {{ $watch->web_name }}</div>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                            @if(!empty($episode->downloads))
                                <div class="text-gray-200 bg-gray-3000 my-3 p-2 rounded">
                                    <h3 class="text-lg text-gray-300 p-2 rounded">Shkarkoje ne hoste te tjere</h3>
                                    <div class="flex flex-wrap">
                                        @foreach($episode->downloads as $download)
                                            <a href="{{ $download->web_url }}" target="_blank">
                                                <div
                                                    class="flex mt-1 h-18 ml-1 p-2 hover:bg-blue-700 hover:text-gray-500 rounded border border-blue-500 transition-bg transition-500 transition-ease-in">
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
                    <div class="w-full md:w-1/4 px-3 rounded-lg">
                        <div class="flex flex-wrap bg-black mt-3 rounded-lg">

                        </div>
                    </div>
                </div>
            </div>
        @endif
    </section>
</div>
