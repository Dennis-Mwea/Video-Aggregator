<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class RecentlyReviewed extends Component
{
    public $recentlyReviewed = [];

    public function render()
    {
        return view('livewire.recently-reviewed');
    }

    public function loadRecentlyReviewed()
    {
        $before = Carbon::now()->subMonths(2)->timestamp;
        $current = Carbon::now()->timestamp;

        $this->recentlyReviewed = Cache::remember('recently-reviewed', 7, function () use ($before, $current) {
            return Http::withHeaders([
                'Authorization' => 'Bearer dcuxy1hq77l3c9yuopjpyh4v5vxnrc',
                'Client-ID' => config('services.igdb.client_id'),
                'Accept' => 'application/json',
            ])->withBody("
                    fields name,cover.url,first_release_date,platforms.abbreviation,rating,total_rating,rating_count,summary,slug;
                    where platforms = {48,49,130,6} & slug != null & cover != null & (first_release_date >= {$before} & first_release_date < {$current} & rating_count > 5);
                    sort rating desc;
                    limit 3;
                ", "text/plain")
                ->post('https://api.igdb.com/v4/games')
                ->json();
        });

    }
}
