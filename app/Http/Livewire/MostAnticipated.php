<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class MostAnticipated extends Component
{
    public $mostAnticipated = [];

    public function render()
    {
        return view('livewire.most-anticipated');
    }

    public function loadMostAnticipatedGames()
    {
        $after4Months = Carbon::now()->addMonths(4)->timestamp;
        $current = Carbon::now()->timestamp;

        $this->mostAnticipated = Cache::remember('most-anticipated', 7, function () use ($after4Months, $current) {
            return Http::withHeaders([
                'Authorization' => 'Bearer dcuxy1hq77l3c9yuopjpyh4v5vxnrc',
                'Client-ID' => config('services.igdb.client_id'),
                'Accept' => 'application/json',
            ])->withBody("
                    fields name,cover.url,first_release_date,platforms.abbreviation,rating,total_rating,slug;
                    where platforms = {48,49,130,6} & slug != null & cover != null & (first_release_date >= {$current} & first_release_date < {$after4Months});
                    sort rating desc;
                    limit 4;
                ", "text/plain")
                ->post('https://api.igdb.com/v4/games')
                ->json();
        });
    }
}
