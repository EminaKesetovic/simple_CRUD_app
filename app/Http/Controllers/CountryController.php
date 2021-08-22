<?php

namespace App\Http\Controllers;

use App\Http\Requests\CountryRequest;
use App\Models\Country;

class CountryController extends Controller
{
    /**
     * Display a listing of the countries.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries = Country::all();

        return response()->json($countries);
    }

    /**
     * Store a newly created country in storage.
     *
     * @param  App\Http\Requests\CountryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CountryRequest $request)
    {
        $country = Country::create($request->post());

        return response()->json([
                                    'message' => 'Country Created Successfully!!',
                                    'country' => $country
                                ]);
    }

    /**
     * Display the specified country.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function show(Country $country)
    {
        return response()->json($country);
    }

    /**
     * Update the specified country in storage.
     *
     * @param  App\Http\Requests\CountryRequest  $request
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function update(CountryRequest $request, Country $country)
    {
        $country->fill($request->post())->save();

        return response()->json([
                                    'message' => 'Country Updated Successfully!!',
                                    'country' => $country
                                ]);
    }

    /**
     * Remove the specified country from storage.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function destroy(Country $country)
    {
        $country->delete();

        return response()->json([
                                    'message' => 'Country Deleted Successfully!!'
                                ]);
    }
}
