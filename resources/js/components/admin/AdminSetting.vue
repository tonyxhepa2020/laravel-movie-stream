<template>
<main>
    <!-- Success alert -->
    <div v-if="successMessage" class="flex bg-green-200 p-2 my-2 rounded-lg">
        <div class="mr-4">
            <div class="h-10 w-10 text-white bg-green-600 rounded-full flex justify-center items-center">
                <i class="material-icons">done</i>
            </div>
        </div>
        <div class="flex justify-between w-full">
            <div class="text-green-600">
                <p class="mb-2 font-bold">
                    Succes alert
                </p>
                <p class="text-xs">
                    {{ successMessage}}
                </p>
            </div>
            <button @click="closeAlert" class="text-gray-500">
                <span class="p-2 hover:bg-green-300 rounded-lg font-bold text-2xl">x</span>
            </button>
        </div>
    </div>
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 border-b border-gray-200 sm:px-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                Make Artisan Calls
            </h3>
        </div>
        <div>
            <dl>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="leading-5 font-medium text-gray-500">
                        Make Inspire Call
                    </dt>
                    <dd class="mt-1 leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                        <button
                            type="submit"
                            @click.prevent="makeInspire"
                            class="inline-flex items-center justify-center py-2 px-4 border border-transparent text-base leading-6 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out disabled:opacity-50">
                            <svg v-if="showInspireLoading" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                                 viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                      d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                            <span>Inspire:run</span>
                        </button>
                    </dd>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="leading-5 font-medium text-gray-500">
                        Make Sitemap:generate Call
                    </dt>
                    <dd class="mt-1 leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                        <button
                            type="submit"
                            @click.prevent="makeSitemap"
                            class="inline-flex items-center justify-center py-2 px-4 border border-transparent text-base leading-6 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out disabled:opacity-50">
                            <svg v-if="showSitemapLoading" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                                 viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                      d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                            <span>Sitemap:generate</span>
                        </button>
                    </dd>
                </div>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="leading-5 font-medium text-gray-500">
                        Make Backup:run Call
                    </dt>
                    <dd class="mt-1 leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                        <button
                            type="submit"
                            @click.prevent="makeBackup"
                            class="inline-flex items-center justify-center py-2 px-4 border border-transparent text-base leading-6 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out disabled:opacity-50">
                            <svg v-if="showBackupLoading" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                                 viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                      d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                            <span>Backup:run</span>
                        </button>
                    </dd>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="leading-5 font-medium text-gray-500">
                        Make Optimize Call
                    </dt>
                    <dd class="mt-1 leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                        <button
                            type="submit"
                            @click.prevent="makeOptimize"
                            class="inline-flex items-center justify-center py-2 px-4 border border-transparent text-base leading-6 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out disabled:opacity-50">
                            <svg v-if="showOptimizeLoading" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                                 viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                      d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                            <span>Optimize:clear</span>
                        </button>
                    </dd>
                </div>
            </dl>
        </div>
    </div>
</main>
</template>

<script>
export default {
    name: "AdminSetting",
    data() {
        return {
            test: '',
            showBackupLoading: false,
            showInspireLoading: false,
            showSitemapLoading: false,
            showOptimizeLoading: false,
            successMessage: ''
        }
    },
    methods: {
        makeBackup(){
            this.showBackupLoading = true;
            axios.get('/api/admin/setting-backup').then(res => {
                this.showBackupLoading = false;
                this.successMessage = res.data
            })
        },
        makeInspire(){
            this.showInspireLoading = true;
            axios.get('/api/admin/setting-inspire').then(res => {
                this.showInspireLoading = false;
                this.successMessage = res.data
            })
        },
        makeSitemap(){
            this.showSitemapLoading = true;
            axios.get('/api/admin/setting-sitemap').then(res => {
                this.showSitemapLoading = false;
                this.successMessage = res.data
            })
        },
        makeOptimize(){
            this.showOptimizeLoading = true;
            axios.get('/api/admin/setting-optimize').then(res => {
                this.showOptimizeLoading = false;
                this.successMessage = res.data
            })
        },
        closeAlert(){
            this.successMessage = '';
        }
    }
}
</script>

<style scoped>

</style>
