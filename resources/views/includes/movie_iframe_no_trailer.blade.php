<section
    id="embed"
    class="container mx-auto rounded-lg mt-2"
>
    <h2 class="text-green-700" hidden>Shiko {{ $movie->title }} me titra shqip</h2>
    @foreach($movie->embeds as $count => $embed)
        <div id="{{ $embed->id }}" class="flex justify-around city hidden">
            <div class="iframe-container bg-black">
                <iframe
                    class="lazyload rounded-lg"
                    ref="frame"
                    src="{{ $embed->web_url }}"
                    frameborder="0"
                    allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen
                    loading="lazy"
                ></iframe>
            </div>
        </div>
    @endforeach
    <div class="flex flex-wrap bg-gray-4000 mt-2 rounded">
        @foreach($movie->embeds as $count => $embed)
            <button
                @if ($loop->first) id="default" @endif
            class="p-1 lg:p-2 m-1 md:m-2 lg:m-2
                            focus:outline-none focus:bg-blue-deep bg-gray-3000 text-gray-200 hover:bg-blue-deep
                            font-bold hover:text-gray-500 rounded shadow tablink"
                onclick="openEmbed(event,'{{ $embed->id }}')">{{ $embed->web_name }}</button>
        @endforeach
    </div>
    <script>
        function openEmbed(evt, cityName) {
            var i, x, tablinks;
            x = document.getElementsByClassName("city");
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablink");
            for (i = 0; i < x.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" bg-blue-deed", "");
            }
            document.getElementById(cityName).style.display = "block";
            evt.currentTarget.className += " bg-blue-deed";
        }
        document.getElementById("default").click();
    </script>
</section>
