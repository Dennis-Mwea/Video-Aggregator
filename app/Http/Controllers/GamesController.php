<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;

class GamesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|Response
     */
    public function index()
    {
        $before = Carbon::now()->subMonths(2)->timestamp;
//        $after = Carbon::now()->addMonths(2)->timestamp;
        $after4Months = Carbon::now()->addMonths(4)->timestamp;
        $current = Carbon::now()->timestamp;
//        $popularGames = Http::withBody('fields name,rating; sort rating desc;', 'text/plain')
//            ->withHeaders([
//                'Authorization' => 'Bearer dcuxy1hq77l3c9yuopjpyh4v5vxnrc',
//                'Client-ID' => config('services.igdb.client_id'),
//                'Accept' => 'application/json',
//            ])
//            ->withBody("
//                fields name,cover.url,first_release_date,platforms.abbreviation,rating,total_rating;
//                where platforms = {48,49,130,6} & cover != null & (first_release_date >= {$before} & first_release_date < {$after});
//                sort rating desc;
//                limit 12;
//            ", "text/plain")
//            ->post('https://api.igdb.com/v4/games')
//            ->json();

        $recentlyReviewed = Http::withBody('fields name,rating; sort rating desc;', 'text/plain')
            ->withHeaders([
                'Authorization' => 'Bearer dcuxy1hq77l3c9yuopjpyh4v5vxnrc',
                'Client-ID' => config('services.igdb.client_id'),
                'Accept' => 'application/json',
            ])
            ->withBody("
                fields name,cover.url,first_release_date,platforms.abbreviation,rating,total_rating,rating_count,summary;
                where platforms = {48,49,130,6} & cover != null & (first_release_date >= {$before} & first_release_date < {$current} & rating_count > 5);
                sort rating desc;
                limit 3;
            ", "text/plain")
            ->post('https://api.igdb.com/v4/games')
            ->json();

        $mostAnticipated = Http::withBody('fields name,rating; sort rating desc;', 'text/plain')
            ->withHeaders([
                'Authorization' => 'Bearer dcuxy1hq77l3c9yuopjpyh4v5vxnrc',
                'Client-ID' => config('services.igdb.client_id'),
                'Accept' => 'application/json',
            ])
            ->withBody("
                fields name,cover.url,first_release_date,platforms.abbreviation,rating,total_rating;
                where platforms = {48,49,130,6} & cover != null & (first_release_date >= {$current} & first_release_date < {$after4Months});
                sort rating desc;
                limit 4;
            ", "text/plain")
            ->post('https://api.igdb.com/v4/games')
            ->json();

        $comingSoon = Http::withBody('fields name,rating; sort rating desc;', 'text/plain')
            ->withHeaders([
                'Authorization' => 'Bearer dcuxy1hq77l3c9yuopjpyh4v5vxnrc',
                'Client-ID' => config('services.igdb.client_id'),
                'Accept' => 'application/json',
            ])
            ->withBody("
                fields name,cover.url,first_release_date,platforms.abbreviation,rating,total_rating;
                where platforms = {48,49,130,6} & cover != null & (first_release_date >= {$current} & first_release_date < {$after4Months});
                sort first_release_date asc;
                limit 4;
            ", "text/plain")
            ->post('https://api.igdb.com/v4/games')
            ->json();

        return view('index', [
            'recentlyReviewed' => $recentlyReviewed,
            'mostAnticipated' => $mostAnticipated,
            'comingSoon' => $comingSoon,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
