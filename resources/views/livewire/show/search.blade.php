<div  x-data="{isOpen: false}">
    <!-- component -->
    <button @click="isOpen = !isOpen" type="submit" class="flex ml-6 p-1 hover:text-gray-400 focus:outline-none focus:shadow-outline">
        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-6 h-6"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
        <span class="ml-2">Search</span>
    </button>
    <div x-show="isOpen" class="fixed z-10 inset-0 overflow-y-auto">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!--
              Background overlay, show/hide based on modal state.

              Entering: "ease-out duration-300"
                From: "opacity-0"
                To: "opacity-100"
              Leaving: "ease-in duration-200"
                From: "opacity-100"
                To: "opacity-0"
            -->
            <div class="fixed inset-0 transition-opacity">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>

            <!-- This element is to trick the browser into centering the modal contents. -->
            <span class="hidden sm:inline-block sm:align-middle"></span>&#8203;
            <!--
              Modal panel, show/hide based on modal state.

              Entering: "ease-out duration-300"
                From: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                To: "opacity-100 translate-y-0 sm:scale-100"
              Leaving: "ease-in duration-200"
                From: "opacity-100 translate-y-0 sm:scale-100"
                To: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            -->
            <div  @click.away="isOpen = false" class="inline-block align-top bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="w-full">
                            <div class="p-2 flex rounded-lg border border-dark">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-6 h-6">
                                    <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                <input class="w-full rounded p-2 font-bold text-gray-700" type="text" placeholder="Kerko Filma Serieale">
                                <div wire:loading class="spinner top-0 right-0 mr-4 mt-3"></div>
                                <button class="bg-red-600 hover:bg-red-500 rounded text-white p-2 pl-4 pr-4">
                                    <p class="font-weight-bold text-xl">Clear</p>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="w-full mt-2">
                        @if (strlen($search) >= 2)
                            <div
                                class="z-50 absolute bg-gray-800 text-sm rounded w-64 mt-4"
                            >
                                @if ($searchResults->count() > 0)
                                    <ul>
                                        @foreach ($searchResults->groupByType() as $type => $modelSearchResults)
                                            <h2>{{ $type }}</h2>
                                            @foreach($modelSearchResults as $searchResult)
                                            <li class="w-full">
                                                <a  class="flex justify-content-around px-2 py-3 bg-gray-700 rounded-lg" href="{{ $searchResult->url }}">
                                                    <div class="flex">
                                                        <div class="ml-3">
                                                            <div class="w-full text-gray-200 font-bold"> {{ $searchResult->title }}</div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                            @endforeach
                                        @endforeach
                                        <li class="flex bg-green-500 hover:bg-green-700 p-2 my-2 rounded-lg border-b border-gray-700">
                                            <a class="pointer-events-auto w-full" href="{{ route('search', ['search' => $search]) }}">Me Shume</a> </li>
                                    </ul>
                                @else
                                    <div class="px-3 py-3">No results for "{{ $search }}"</div>
                                @endif
                            </div>
                        @endif
                        <ul class="p-2">
                            <li class="w-full">
                                <a href=""  class="flex justify-content-around px-2 py-3 bg-gray-700 rounded-lg">
                                    <span>Title goes hire</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
          <button @click="isOpen = false" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
            Cancel
          </button>
        </span>
                </div>
            </div>
        </div>
    </div>
</div>
