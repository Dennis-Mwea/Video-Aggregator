@extends('layouts.backup')

@section('content')
    <div class="container mx-auto px-4">
        <h2 class="text-blue-500 uppercase tracking-wide font-semibold">Popular Games</h2>

        <div
            class="popular-games grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 xl:grid-cols-6 gap-12 border-b border-gray-800 pb-16">
            @if(isset($popularGames) && count($popularGames) > 0)
                @foreach($popularGames as $popularGame)
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
                @endforeach
            @endif
        </div>

        <div class="flex flex-col lg:flex-row my-10">
            <div class="recently-reviewed w-full lg:w-3/4 mr-0 lg:mr-32">
                <h2 class="uppercase tracking-wide text-blue-500 font-semibold">Recently Reviewed</h2>

                <div class="recently-reviewed-container space-y-12 mt-8">
                    @if(isset($recentlyReviewed) && count($recentlyReviewed) > 0)
                        @foreach($recentlyReviewed as $game)
                            <div class="game bg-gray-800 rounded-lg shadow-md flex p-6">
                                <div class="relative inline-block flex-none">
                                    <a href="#">
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
                                    <a href="#"
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
                        @endforeach
                    @endif
                </div>
            </div>

            <div class="most-anticipated w-full lg:w-1/4 mt-12 lg:mt-0">
                <h2 class="uppercase tracking-wide text-blue-500 font-semibold">Most Anticipated</h2>
                <div class="most-anticipated-container space-y-10 mt-8">
                    @if(isset($mostAnticipated) && count($mostAnticipated) > 0)
                        @foreach($mostAnticipated as $game)
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

                <h2 class="uppercase tracking-wide text-blue-500 mt-16 font-semibold">Coming Soon</h2>
                <div class="most-anticipated-container space-y-10 mt-8">
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
            </div>
        </div>
    </div>
@endsection
