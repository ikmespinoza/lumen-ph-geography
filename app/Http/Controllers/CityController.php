<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Resources\CityResource;

use App\Models\City;
use App\Models\Province;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($region, $province)
    {
        $province = Province::where('id', $province)
                        ->where('region_id', $region)
                        ->first();

        if(!$province) {
            return $this->errorResponse('Province information not found.', 200);
        }

        $cities = City::select(array(
                    'cities.*',
                ))->join('provinces', 'provinces.id', 'cities.province_id')
                ->where('provinces.id', $province->id)
                ->orderBy('cities.name')
                ->with(['classification', 'province'])->get();

        return $this->successResponse($cities);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, City $city)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        //
    }
}