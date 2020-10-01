<template>
<main class="grid grid-cols-3 gap-4">
    <div v-if="users" class="rounded h-full flex justify-center items-center">
        <div class="rounded-lg text-bold bg-black shadow-md h-48 w-48 p-6 flex flex-col justify-around">
            <div>
                <p class="text-base text-green-600">Users</p>
            </div>
            <div>
                <p class="text-2xl text-green-700 font-bold">{{ users.length }}</p>
            </div>
            <div class="text-sm">
                <p class="text-green-600">Since last month</p>
            </div>
        </div>
    </div>
    <div v-if="movies" class="rounded h-full flex justify-center items-center">
        <div class="rounded-lg text-bold bg-black shadow-md h-48 w-48 p-6 flex flex-col justify-around">
            <div>
                <p class="text-base text-green-600">Movies</p>
            </div>
            <div>
                <p class="text-2xl text-green-700 font-bold">{{ movies.length }}</p>
            </div>
            <div class="text-sm">
                <p class="text-green-600">Since last month</p>
            </div>
        </div>
    </div>
    <div v-if="series" class="rounded h-full flex justify-center items-center">
        <div class="rounded-lg text-bold bg-black shadow-md h-48 w-48 p-6 flex flex-col justify-around">
            <div>
                <p class="text-base text-green-600">Series</p>
            </div>
            <div>
                <p class="text-2xl text-green-700 font-bold">{{ series.length }}</p>
            </div>
            <div class="text-sm">
                <p class="text-green-600">Since last month</p>
            </div>
        </div>
    </div>
    <div v-if="genres" class="rounded h-full flex justify-center items-center">
        <div class="rounded-lg text-bold bg-black shadow-md h-48 w-48 p-6 flex flex-col justify-around">
            <div>
                <p class="text-base text-green-600">Genres</p>
            </div>
            <div>
                <p class="text-2xl text-green-700 font-bold">{{ genres.length }}</p>
            </div>
            <div class="text-sm">
                <p class="text-green-600">Since last month</p>
            </div>
        </div>
    </div>
    <div v-if="tags" class="rounded h-full flex justify-center items-center">
        <div class="rounded-lg text-bold bg-black shadow-md h-48 w-48 p-6 flex flex-col justify-around">
            <div>
                <p class="text-base text-green-600">Tags</p>
            </div>
            <div>
                <p class="text-2xl text-green-700 font-bold">{{ tags.length }}</p>
            </div>
            <div class="text-sm">
                <p class="text-green-600">Since last month</p>
            </div>
        </div>
    </div>
    <div v-if="casts" class="rounded h-full flex justify-center items-center">
        <div class="rounded-lg text-bold bg-black shadow-md h-48 w-48 p-6 flex flex-col justify-around">
            <div>
                <p class="text-base text-green-600">Casts</p>
            </div>
            <div>
                <p class="text-2xl text-green-700 font-bold">{{ casts.length }}</p>
            </div>
            <div class="text-sm">
                <p class="text-green-600">Since last month</p>
            </div>
        </div>
    </div>
</main>
</template>

<script>
export default {
    name: "Dashboard",
    data() {
        return {
            users: [],
            movies: [],
            series: [],
            genres: [],
            tags: [],
            casts: []
        }
    },
    async created() {
        await this.getUsers();
        await this.getMovies();
        await this.getSeries();
        await this.getGenres();
        await this.getTags();
        await this.getCasts();
    },
    methods: {
        getUsers() {
            const url =  '/api/admin/dashboard-users'
            const _this = this;
            axios.get(url)
                .then(res => {
                    _this.users = res.data;
                }).catch(error => {
                    console.log(error);
            })
        },
        getMovies() {
            const url =  '/api/admin/dashboard-movies'
            const _this = this;
            axios.get(url)
                .then(res => {
                    _this.movies = res.data;
                }).catch(error => {
                console.log(error);
            })
        },
        getSeries() {
            const url =  '/api/admin/dashboard-series'
            const _this = this;
            axios.get(url)
                .then(res => {
                    _this.series = res.data;
                }).catch(error => {
                console.log(error);
            })
        },
        getGenres() {
            const url =  '/api/admin/dashboard-genres'
            const _this = this;
            axios.get(url)
                .then(res => {
                    _this.genres = res.data;
                }).catch(error => {
                console.log(error);
            })
        },
        getTags() {
            const url =  '/api/admin/dashboard-tags'
            const _this = this;
            axios.get(url)
                .then(res => {
                    _this.tags = res.data;
                }).catch(error => {
                console.log(error);
            })
        },
        getCasts() {
            const url =  '/api/admin/dashboard-casts'
            const _this = this;
            axios.get(url)
                .then(res => {
                    _this.casts = res.data;
                }).catch(error => {
                console.log(error);
            })
        }
    }
}
</script>

<style scoped>

</style>
