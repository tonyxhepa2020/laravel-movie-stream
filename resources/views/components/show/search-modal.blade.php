<div  x-data="{isOpen: false}">
    <!-- component -->
    <button @click="isOpen = !isOpen" type="submit" class="flex ml-6 p-1 focus:outline-none focus:shadow-outline">
        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-6 h-6"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
        <span class="ml-2">Search</span>
    </button>
    <div x-show="isOpen" x-cloak="" class="fixed inset-0 z-50 flex justify-center items-center">
        <div class="bg-white rounded shadow-lg p-8 relative">
            <button class="absolute right-0 top-0 px-3 py-1" @click="isOpen = false">x</button>
            I'm a modal
        </div>
    </div>
{{--    <div x-show="isOpen" x-cloak="" class="fixed z-10 inset-0 overflow-y-auto">--}}
{{--        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">--}}
{{--            <!----}}
{{--              Background overlay, show/hide based on modal state.--}}

{{--              Entering: "ease-out duration-300"--}}
{{--                From: "opacity-0"--}}
{{--                To: "opacity-100"--}}
{{--              Leaving: "ease-in duration-200"--}}
{{--                From: "opacity-100"--}}
{{--                To: "opacity-0"--}}
{{--            -->--}}
{{--            <div class="fixed inset-0 transition-opacity">--}}
{{--                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>--}}
{{--            </div>--}}

{{--            <!-- This element is to trick the browser into centering the modal contents. -->--}}
{{--            <span class="hidden sm:inline-block sm:align-middle"></span>&#8203;--}}
{{--            <!----}}
{{--              Modal panel, show/hide based on modal state.--}}

{{--              Entering: "ease-out duration-300"--}}
{{--                From: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"--}}
{{--                To: "opacity-100 translate-y-0 sm:scale-100"--}}
{{--              Leaving: "ease-in duration-200"--}}
{{--                From: "opacity-100 translate-y-0 sm:scale-100"--}}
{{--                To: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"--}}
{{--            -->--}}
{{--            <div  @click.away="isOpen = false" class="inline-block align-top bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">--}}
{{--                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">--}}
{{--                    <div class="sm:flex sm:items-start">--}}
{{--                        <div class="w-full">--}}
{{--                            <div class="p-2 flex rounded-lg border border-dark">--}}
{{--                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-6 h-6">--}}
{{--                                    <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>--}}
{{--                                <input class="w-full rounded p-2 font-bold text-gray-700" type="text" placeholder="Kerko Filma Seriale Aktore">--}}
{{--                                <button class="bg-green-200 hover:bg-green-300 rounded text-white p-2 pl-4 pr-4">--}}
{{--                                    <p class="font-semibold text-xl">Clear</p>--}}
{{--                                </button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">--}}
{{--        <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">--}}
{{--          <button type="button" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-red-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5">--}}
{{--            Deactivate--}}
{{--          </button>--}}
{{--        </span>--}}
{{--                    <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">--}}
{{--          <button type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">--}}
{{--            Cancel--}}
{{--          </button>--}}
{{--        </span>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
</div>

