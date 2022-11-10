<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Resources\ProvinceResource;

use App\Models\Province;

class ProvinceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  int  $region
     * @return \Illuminate\Http\Response
     */
    public function index($region)
    {
        $provinces = Province::select(array(
                        'provinces.*',
                    ))->join('regions', 'regions.id', 'provinces.region_id')
                    ->where('regions.id', $region)
                    ->orderBy('provinces.name')
                    ->with(['region'])->get();

        return $this->successResponse($provinces);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $region
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $region)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $region
     * @param  int  $province
     * @return \Illuminate\Http\Response
     */
    public function show($region, $province)
    {
        $province = Province::where('id', $province)
                        ->where('region_id', $region)
                        ->first();

        if($province) {
            return $this->successResponse(new ProvinceResource($province));
        }

        return $this->errorResponse('Province information not found.', 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $region
     * @param  int  $province
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $region,  $province)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $province
     * @param  int  $region
     * @return \Illuminate\Http\Response
     */
    public function destroy($region, $province)
    {
        //
    }
}