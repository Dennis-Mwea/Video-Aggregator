<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class PopularGames extends Component
{
    public $popularGames = [];

    public function render()
    {
        return view('livewire.popular-games');
    }

    public function loadPopularGames()
    {
        $before = Carbon::now()->subMonths(2)->timestamp;
        $after = Carbon::now()->addMonths(2)->timestamp;

        $this->popularGames = Cache::remember('popular-games', 7, function () use ($before, $after) {
            return Http::withBody('fields name,rating; sort rating desc;', 'text/plain')
                ->withHeaders([
                    'Authorization' => 'Bearer dcuxy1hq77l3c9yuopjpyh4v5vxnrc',
                    'Client-ID' => config('services.igdb.client_id'),
                    'Accept' => 'application/json',
                ])
                ->withBody("
                    fields name,cover.url,first_release_date,platforms.abbreviation,rating,total_rating,slug;
                    where platforms = {48,49,130,6} & slug != null & cover != null & (first_release_date >= {$before} & first_release_date < {$after});
                    sort rating desc;
                    limit 12;
                ", "text/plain")
                ->post('https://api.igdb.com/v4/games')
                ->json();
        });
    }
}
