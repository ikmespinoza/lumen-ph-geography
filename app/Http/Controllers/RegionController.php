<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Resources\RegionResource;

use App\Models\Region;

class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $regions = Region::orderBy('name')->get();

        return $this->successResponse($regions);
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
     * @param  int  $region
     * @return \Illuminate\Http\Response
     */
    public function show($region)
    {
        $region = Region::find($region);

        if($region) {
            return $this->successResponse(new RegionResource($region));
        }

        return $this->errorResponse('Region information not found.', 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $region
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $region)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $region
     * @return \Illuminate\Http\Response
     */
    public function destroy($region)
    {
        //
    }
}