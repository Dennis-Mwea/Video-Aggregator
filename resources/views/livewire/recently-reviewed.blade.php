<div wire:init="loadRecentlyReviewed" class="recently-reviewed-container space-y-12 mt-8">
    @forelse($recentlyReviewed as $game)
        <div class="game bg-gray-800 rounded-lg shadow-md flex p-6">
            <div class="relative inline-block flex-none">
                <a href="{{ route('games.show', $game['slug']) }}">
                    <img src="{{ str_replace('thumb', 'cover_big', $game['cover']['url']) }}"
                         alt="game cover"
                         class="hover:opacity-75 transition ease-in-out duration-150 w-20 lg:w-48">
                </a>

                @if(array_key_exists('rating', $game))
                    <div class="absolute bottom-0 right-0 w-16 h-16 bg-gray-900 rounded-full"
                         style="right: -20px; bottom: -20px">
                        <div class="font-semibold text-xs flex justify-center items-center h-full">
                            {{ round($game['rating'], 0) }}%
                        </div>
                    </div>
                @endif
            </div>

            <div class="ml-6 lg:ml-12">
                <a href="{{ route('games.show', $game['slug']) }}"
                   class="block text-lg font-semibold leading-tight hover:text-gray-400 mt-0 lg:mt-4">
                    {{ $game['name'] }}
                </a>
                <div class="text-gray-400 mt-1">
                    @foreach($game['platforms'] as $platform)
                        @if (array_key_exists('abbreviation', $platform))
                            {{ $platform['abbreviation'] }},
                        @endif
                    @endforeach
                </div>

                <p class="mt-6 text-gray-400  hidden lg:block">
                    {{ $game['summary'] }}
                </p>
            </div>
        </div>
    @empty
        @foreach(range(0, 2) as $game)
            <div class="game bg-gray-800 rounded-lg shadow-md flex p-6">
                <div class="relative inline-block flex-none">
                    <div class="bg-gray-700 w-32 lg:w-48 h-40 lg:h-56"></div>
                </div>

                <div class="ml-6 lg:ml-12">
                    <div class="inline-block text-lg text-transparent rounded bg-gray-800 leading-tight mt-0 lg:mt-4">
                        Title goes here
                    </div>

                    <div class="mt-8 space-y-4 hidden lg:block">
                        <span class="text-transparent rounded bg-gray-700 inline-block">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Lorem ipsum.</span>
                        <span class="text-transparent rounded bg-gray-700 inline-block">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Lorem ipsum.</span>
                        <span class="text-transparent rounded bg-gray-700 inline-block">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Lorem ipsum.</span>
                    </div>
                </div>
            </div>
        @endforeach
    @endforelse
</div>
