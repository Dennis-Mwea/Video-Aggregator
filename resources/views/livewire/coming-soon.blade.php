<div wire:init="loadComingSoonGames" class="most-anticipated-container space-y-10 mt-8">
    @if(isset($comingSoon) && count($comingSoon) > 0)
        @foreach($comingSoon as $game)
            <div class="game flex">
                <a href="#">
                    <img src="{{ str_replace('thumb', 'cover_small', $game['cover']['url']) }}"
                         alt="game cover"
                         class="hover:opacity-75 transition ease-in-out duration-150 w-16">
                </a>
                <div class="ml-4">
                    <a href="#" class="hover:text-gray-300">{{ $game['name'] }}</a>
                    <p class="text-gray-400 text-sm mt-1">
                        {{ \Carbon\Carbon::parse($game['first_release_date'])->format('M d, Y') }}
                    </p>
                </div>
            </div>
        @endforeach
    @endif
</div>
