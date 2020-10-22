<div wire:init="loadGame" class="container mx-auto px-4">
    @if(count($game) > 0)
        <div class="game-details border-b border-gray-800 pb-12 flex flex-col lg:flex-row">

            <div class="flex-none">
                <img src="{{ str_replace('thumb', 'cover_big', $game['cover']['url']) }}" alt="Cover">
            </div>

            <div class="ml-0 lg:ml-12 mr-0 lg:mr-64">
                <h2 class="font-semibold text-4xl mt-1 leading-tight">{{ $game['name'] }}</h2>
                <div class="text-gray-400">
                <span>
                    @foreach($game['genres'] as $genre)
                        {{ $genre['name'] }},
                    @endforeach
                </span>
                    &middot;
                    <span>{{ $game['involved_companies'][0]['company']['name'] }}</span>
                    &middot;
                    <span>
                    @foreach($game['platforms'] as $platform)
                            @if (array_key_exists('abbreviation', $platform))
                                {{ $platform['abbreviation'] }},
                            @endif
                        @endforeach
                </span>
                </div>

                <div class="flex flex-wrap items-center mt-8">
                    <div class="flex items-center">
                        <div class="w-16 h-16 bg-gray-800 rounded-full">
                            <div class="font-semibold text-xs flex justify-center items-center h-full">
                                @if(array_key_exists('rating', $game))
                                    {{ round($game['rating'], 0) }}%
                                @else
                                    0%
                                @endif
                            </div>
                        </div>

                        <div class="ml-4 text-xs">Member <br>Score</div>
                    </div>

                    <div class="flex items-center ml-12">
                        <div class="w-16 h-16 bg-gray-800 rounded-full">
                            <div class="font-semibold text-xs flex justify-center items-center h-full">
                                @if(array_key_exists('aggregated_rating', $game))
                                    {{ round($game['aggregated_rating'], 0) }}%
                                @else
                                    0%
                                @endif
                            </div>
                        </div>

                        <div class="ml-4 text-xs">Critic <br>Score</div>
                    </div>

                    <div class="flex items-center space-x-4 mt-4 lg:mt-0 lg:ml-12">
                        <div class="w-8 h-8 bg-gray-800 rounded-full flex justify-center items-center">
                            <a href="#" class="hover:text-gray-400">
                                w
                            </a>
                        </div>
                        <div class="w-8 h-8 bg-gray-800 rounded-full flex justify-center items-center">
                            <a href="#" class="hover:text-gray-400">
                                i
                            </a>
                        </div>
                        <div class="w-8 h-8 bg-gray-800 rounded-full flex justify-center items-center">
                            <a href="#" class="hover:text-gray-400">
                                f
                            </a>
                        </div>
                        <div class="w-8 h-8 bg-gray-800 rounded-full flex justify-center items-center">
                            <a href="#" class="hover:text-gray-400">
                                t
                            </a>
                        </div>
                    </div>
                </div>

                <p class="mt-12">
                    {{ $game['summary'] }}
                </p>

                <div class="mt-12">
                    {{--                <button--}}
                    {{--                    class="flex bg-blue-500 text-white font-semibold px-4 py-4 hover:bg-blue-600 rounded transition ease-in-out duration-150">--}}
                    {{--                    <svg class="w-6 fill-current" viewBox="0 0 24 24">--}}
                    {{--                        <path d="M0 0h24v24H0z" fill="none"></path>--}}
                    {{--                        <path--}}
                    {{--                            d="M10 16.5l6-4.5-6-4.5v9zM12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"></path>--}}
                    {{--                    </svg>--}}
                    {{--                    <span class="ml-2">Play Trailer</span>--}}
                    {{--                </button>--}}
                    <a target="_blank" href="https://youtube.com/watch/{{ $game['videos'][0]['video_id'] }}"
                       class="inline-flex bg-blue-500 text-white font-semibold px-4 py-4 hover:bg-blue-600 rounded transition ease-in-out duration-150">
                        <svg class="w-6 fill-current" viewBox="0 0 24 24">
                            <path d="M0 0h24v24H0z" fill="none"></path>
                            <path
                                d="M10 16.5l6-4.5-6-4.5v9zM12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"></path>
                        </svg>
                        <span class="ml-2">Play Trailer</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="images-container border-b border-gray-800 pb-12 mt-8">
            <h2 class="text-blue-500 uppercase tracking-wide font-semibold">Images</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12 mt-8">
                @foreach($game['screenshots'] as $screenshot)
                    @if(array_key_exists('url', $screenshot))
                        <div>
                            <a href="{{ str_replace('thumb', 'screenshot_huge', $screenshot['url']) }}">
                                <img src="{{ str_replace('thumb', 'screenshot_big', $screenshot['url']) }}"
                                     alt="screenshot"
                                     class="hover:opacity-75 transition ease-in-out duration-150">
                            </a>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>

        <div class="images-container">
            <h2 class="text-blue-500 uppercase tracking-wide font-semibold">Similar Games</h2>

            <div
                class="popular-games grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 xl:grid-cols-6 gap-12">
                @foreach($game['similar_games'] as $similarGame)

                    <div class="game mt-8">
                        <div class="relative inline-block">
                            @if(array_key_exists('cover', $similarGame))
                                <a href="{{ route('games.show', $similarGame['slug']) }}">
                                    <img src="{{ str_replace('thumb', 'cover_big', $similarGame['cover']['url']) }}"
                                         alt="game cover"
                                         class="hover:opacity-75 transition ease-in-out duration-150">
                                </a>
                            @endif

                            @if(array_key_exists('rating', $similarGame))
                                <div class="absolute bottom-0 right-0 w-16 h-16 bg-gray-800 rounded-full"
                                     style="right: -20px; bottom: -20px">
                                    <div class="font-semibold text-xs flex justify-center items-center h-full">
                                        {{ round($similarGame['rating'], 0) }}
                                    </div>
                                </div>
                            @endif
                        </div>

                        <a href="#" class="block text-base font-semibold leading-tight hover:text-gray-400 mt-8">
                            {{ $similarGame['name'] }}
                        </a>
                        <div class="text-gray-400 mt-1">
                            @foreach($similarGame['platforms'] as $platform)
                                @if (array_key_exists('abbreviation', $platform))
                                    {{ $platform['abbreviation'] }},
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
