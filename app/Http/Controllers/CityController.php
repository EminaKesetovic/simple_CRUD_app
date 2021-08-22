<?php

namespace App\Http\Controllers;

use App\Http\Requests\CityRequest;
use App\Models\City;

class CityController extends Controller
{
    /**
     * Display a listing of the cities.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities = City::all();

        return response()->json($cities);
    }

    /**
     * Store a newly created city in storage.
     *
     * @param  App\Http\Requests\CityRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CityRequest $request)
    {
        $city = City::create($request->post());

        return response()->json([
                                    'message' => 'City Created Successfully!!',
                                    'city'    => $city
                                ]);
    }

    /**
     * Display the specified city.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        return response()->json($city);
    }

    /**
     * Update the specified city in storage.
     *
     * @param  App\Http\Requests\CityRequest  $request
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(CityRequest $request, City $city)
    {
        $city->fill($request->post())->save();

        return response()->json([
                                    'message' => 'City Updated Successfully!!',
                                    'city'    => $city
                                ]);
    }

    /**
     * Remove the specified city from storage.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        $city->delete();

        return response()->json([
                                    'message' => 'City Deleted Successfully!!'
                                ]);
    }
}
