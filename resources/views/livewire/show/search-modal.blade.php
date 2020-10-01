<div  x-data="{isOpen: false}">
    <!-- component -->
    <button @click="isOpen = !isOpen" type="submit" class="flex ml-6 p-1 hover:text-gray-400 focus:outline-none focus:shadow-outline">
        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-6 h-6"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
        <span class="ml-2">Search</span>
    </button>
    <div x-show="isOpen" class="fixed z-10 inset-0 overflow-y-auto hidden" x-cloak="" :class="{'block': open, 'hidden': !open}">
        <div class="flex items-top justify-center pt-4 px-4 pb-20 text-center sm:block sm:p-0">
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
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>&#8203;
            <!--
              Modal panel, show/hide based on modal state.

              Entering: "ease-out duration-300"
                From: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                To: "opacity-100 translate-y-0 sm:scale-100"
              Leaving: "ease-in duration-200"
                From: "opacity-100 translate-y-0 sm:scale-100"
                To: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            -->
            <div
                @click.away="isOpen = false"
                x-on:click.away="$wire.resetAll()"
                class="inline-block align-top text-gray-200 bg-gray-800 rounded-lg text-left overflow-x-hidden shadow-xl transform transition-all sm:my-8 sm:align-top sm:max-w-lg" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                <div class="text-gray-200 bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="w-full">
                            <div class="p-2 flex rounded-lg">
                                <input wire:model.debounce.500ms="search" class="w-full rounded p-2 font-bold bg-gray-600 text-gray-100" type="text" placeholder="Kerko Filma Seriale Aktore">
                                     <button wire:click="resetAll" class="bg-red-600 hover:bg-red-500 rounded text-white p-4 ml-2">
                                    <p class="font-weight-bold text-xl">Clear</p>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="w-full mt-2">
                        <svg wire:loading class="animate-spin top-0 right-0 mr-4 mt-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor"
                                  d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                            </path>
                        </svg>
                    @if (strlen($search) >= 2)
                            <div class="rounded mt-4">
                                @if ($searchResults->count() > 0)
                                    <ul>
                                        @foreach($searchResults as $searchResult)
                                            <li class="w-full mb-1">
                                                <a  class="flex justify-content-around px-2 py-3 bg-gray-700 hover:bg-gray-600 rounded-lg" href="{{ $searchResult->slug }}">
                                                    <div class="flex flex-wrap">
                                                        <div class="ml-3">
                                                            <div class="w-full text-gray-200 font-bold"> {{ $searchResult->title }}</div>
                                                            <span class="text-sm">{{ $searchResult->type }}</span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <div class="px-3 py-3">No results for "{{ $search }}"</div>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
                <div class="bg-gray-500 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
          <button x-on:click="$wire.resetAll()"
                  @click="isOpen = false"
                  type="button"
                  class="inline-flex justify-center w-full rounded-md border px-4 py-2 text-gray-200 bg-gray-800 text-base leading-6 font-medium shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
            Cancel
          </button>
        </span>
                </div>
            </div>
        </div>
    </div>
</div>
