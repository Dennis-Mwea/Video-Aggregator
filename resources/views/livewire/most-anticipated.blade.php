<div wire:init="loadMostAnticipatedGames" class="most-anticipated-container space-y-10 mt-8">
    @forelse($mostAnticipated as $game)
        <div class="game flex">
            <a href="{{ route('games.show', $game['slug']) }}">
                <img src="{{ str_replace('thumb', 'cover_small', $game['cover']['url']) }}"
                     alt="game cover"
                     class="hover:opacity-75 transition ease-in-out duration-150 w-16">
            </a>
            <div class="ml-4">
                <a href="{{ route('games.show', $game['slug']) }}" class="hover:text-gray-300">{{ $game['name'] }}</a>
                <p class="text-gray-400 text-sm mt-1">
                    {{ \Carbon\Carbon::parse($game['first_release_date'])->format('M d, Y') }}
                </p>
            </div>
        </div>
    @empty
        @foreach(range(0, 3) as $game)
            <div class="game flex">
                <div class="bg-gray-800 w-16 h-20 flex-none"></div>
                <div class="ml-4">
                    <div class="text-transparent rounded bg-gray-700 leading-tight">Title goes here</div>
                    <div class="text-transparent rounded inline-block bg-gray-700 mt-2 leading-tight">Sept 14, 2020
                    </div>
                </div>
            </div>
        @endforeach
    @endforelse
</div>
