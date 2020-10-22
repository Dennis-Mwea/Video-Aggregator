<div wire:init="loadPopularGames"
     class="popular-games grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 xl:grid-cols-6 gap-12 border-b border-gray-800 pb-16">
    @forelse($popularGames as $popularGame)
        <div class="game mt-8">
            <div class="relative inline-block">
                <a href="#">
                    <img src="{{ str_replace('thumb', 'cover_big', $popularGame['cover']['url']) }}"
                         alt="game cover"
                         class="hover:opacity-75 transition ease-in-out duration-150">
                </a>

                @if(array_key_exists('rating', $popularGame))
                    <div class="absolute bottom-0 right-0 w-16 h-16 bg-gray-800 rounded-full"
                         style="right: -20px; bottom: -20px">
                        <div class="font-semibold text-xs flex justify-center items-center h-full">
                            {{ round($popularGame['rating'], 0) }}%
                        </div>
                    </div>
                @endif
            </div>

            <a href="#" class="block text-base font-semibold leading-tight hover:text-gray-400 mt-8">
                {{ $popularGame['name'] }}
            </a>
            <div class="text-gray-400 mt-1">
                @foreach($popularGame['platforms'] as $platform)
                    @if (array_key_exists('abbreviation', $platform))
                        {{ $platform['abbreviation'] }},
                    @endif
                @endforeach
            </div>
        </div>
    @empty
        @foreach(range(0, 11) as $game)
            <div class="game mt-8">
                <div class="relative inline-block">
                    <div class="bg-gray-800 w-44 h-56"></div>
                </div>

                <div class="block text-transparent text-lg bg-gray-700 leading-tight rounded mt-4">
                    Title goes here
                </div>
                <div class="text-transparent bg-gray-700 rounded mt-3 inline-block">PS4, PC, Switch</div>
            </div>
        @endforeach
    @endforelse
</div>
