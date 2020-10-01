<template>
<main class="flex justify-between">
    <div>
        <p class="text-sm text-gray-700 leading-5">
            <span>Showing</span>
            <span class="font-medium">{{pagination.from}}</span>
            <span>to</span>
            <span class="font-medium">{{pagination.to}}</span>
            <span>of</span>
            <span class="font-medium">{{pagination.total}}</span>
            <span>results</span>
        </p>
    </div>
    <div>
          <span class="relative z-0 inline-flex shadow-sm">
            <span>
              <button
                  v-if="pagination.prevPageUrl"
                  @click="$emit('prev')"
                  dusk="previousPage.after"
                  rel="prev"
                  class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-l-md leading-5 hover:text-gray-400 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150"
                  aria-label="&amp;laquo; Previous"
              >
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                  <path
                      fill-rule="evenodd"
                      d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                      clip-rule="evenodd"
                  ></path>
                </svg>
              </button>
                <span
                    v-else :disabled="true"
                    dusk="previousPage.after"
                    rel="prev"
                    class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-l-md leading-5 hover:text-gray-400 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150"
                    aria-label="&amp;laquo; Previous"
                >
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                  <path
                      fill-rule="evenodd"
                      d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                      clip-rule="evenodd"
                  ></path>
                </svg>
              </span>
            </span>

            <span>
              <button
                  v-if="pagination.nextPageUrl"
                  @click="$emit('next')"
                  dusk="nextPage.after"
                  rel="next"
                  class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-r-md leading-5 hover:text-gray-400 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150"
                  aria-label="Next &amp;raquo;"
              >
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                  <path
                      fill-rule="evenodd"
                      d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                      clip-rule="evenodd"
                  ></path>
                </svg>
              </button>
                 <span
                     v-else
                     :disabled="true"
                     rel="next"
                     class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-r-md leading-5 hover:text-gray-400 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150"
                     aria-label="Next &amp;raquo;"
                 >
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                  <path
                      fill-rule="evenodd"
                      d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                      clip-rule="evenodd"
                  ></path>
                </svg>
              </span>
            </span>
          </span>
    </div>
</main>
</template>

<script>
export default {
    name: "Pagination",
    props: ['pagination', 'client', 'filtered']
}
</script>

<style scoped>

</style>
