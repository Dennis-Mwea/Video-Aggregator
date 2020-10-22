<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class GameDetails extends Component
{
    public $game = [];

    public $slug;

    public function render()
    {
        return view('livewire.game-details');
    }

    public function loadGame()
    {
        Log::info($this->slug);
        $this->game = Cache::remember('game-details', 30, function () {
            return Http::withHeaders([
                'Authorization' => 'Bearer dcuxy1hq77l3c9yuopjpyh4v5vxnrc',
                'Client-ID' => config('services.igdb.client_id'),
                'Accept' => 'application/json',
            ])
                ->withBody("
                    fields name,cover.url,first_release_date,platforms.abbreviation,rating,total_rating,slug," .
                    "involved_companies.company.name,genres.name,aggregated_rating,summary,websites.*,videos.*" .
                    ",screenshots.*,similar_games.cover.url,similar_games.name,
                    similar_games.rating,similar_games.platforms.abbreviation,similar_games.slug;
                    where slug = \"{$this->slug}\" & similar_games.cover != null;
                ", "text/plain")
                ->post('https://api.igdb.com/v4/games')
                ->json()[0];
        });
        Log::info($this->game);
        abort_if(!$this->game, 404);
    }
}
