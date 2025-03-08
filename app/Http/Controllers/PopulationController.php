<?php

namespace App\Http\Controllers;

use App\Models\Population;
use Illuminate\Http\Request;

class PopulationController extends Controller
{
    public function index()
    {
        $isDatabaseEmpty = true;

        $databaseCounter = Population::count();
        if ($databaseCounter>0) {
            $isDatabaseEmpty = false;
            $years = Population::select('year')->distinct()->orderBy('year', 'asc')->get();
            $prefectures = Population::select('prefecture')->distinct()->orderBy('prefecture', 'asc')->get();
        }
        if ($isDatabaseEmpty) {
            return view('welcome', [
                'isDatabaseEmpty' => $isDatabaseEmpty,
                'query_result' => [],
                'years' => [],
                'prefectures' => [],
            ]);
        }
        return view('welcome', [
            'isDatabaseEmpty' => $isDatabaseEmpty,
            'query_result' => [],
            'years' => $years,
            'prefectures' => $prefectures,
        ]);
    }

    public function getPopulation(Request $request)
    {
        $query_result = [];
        $years = [];
        $prefectures = [];
        $isDatabaseEmpty = true;

        $databaseCounter = Population::count();
        if ($databaseCounter>0) {
            $isDatabaseEmpty = false;
            $years = Population::select('year')->distinct()->orderBy('year', 'asc')->get();
            $prefectures = Population::select('prefecture')->distinct()->orderBy('prefecture', 'asc')->get();
        }
        if ($isDatabaseEmpty) {
            return view('welcome', ['isDatabaseEmpty' => $isDatabaseEmpty, 'query_result' => [],
                'years' => [],
                'prefectures' => [],
            ]);
        }
        if($request->has('prefecture') && request()->has('year')){
            $prefecture = $request->input('prefecture');
            $year = $request->input('year');
            $query_result = Population::where('prefecture', $prefecture)->where('year', $year)->get();

        }
        return view('welcome',compact('query_result','years','prefectures'))->with('isDatabaseEmpty');
    }
}
