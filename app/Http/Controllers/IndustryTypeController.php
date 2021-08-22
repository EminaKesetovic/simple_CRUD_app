<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndustryTypeRequest;
use App\Models\IndustryType;

class IndustryTypeController extends Controller
{
    /**
     * Display a listing of the industry types.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $industryTypes = IndustryType::all();

        return response()->json($industryTypes);
    }

    /**
     * Store a newly created industry type in storage.
     *
     * @param  App\Http\Requests\IndustryTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(IndustryTypeRequest $request)
    {
        $industryType = IndustryType::create($request->post());

        return response()->json([
                                    'message'       => 'Industry Type Created Successfully!!',
                                    'industry_type' => $industryType
                                ]);
    }

    /**
     * Display the specified industry type.
     *
     * @param  \App\Models\IndustryType  $industryType
     * @return \Illuminate\Http\Response
     */
    public function show(IndustryType $industryType)
    {
        return response()->json($industryType);
    }

    /**
     * Update the specified industry type in storage.
     *
     * @param  App\Http\Requests\IndustryTypeRequest  $request
     * @param  \App\Models\IndustryType  $industryType
     * @return \Illuminate\Http\Response
     */
    public function update(IndustryTypeRequest $request, IndustryType $industryType)
    {
        $industryType->fill($request->post())->save();

        return response()->json([
                                    'message'       => 'Industry Type Updated Successfully!!',
                                    'industry_type' => $industryType
                                ]);
    }

    /**
     * Remove the specified industry type from storage.
     *
     * @param  \App\Models\IndustryType  $industryType
     * @return \Illuminate\Http\Response
     */
    public function destroy(IndustryType $industryType)
    {
        $industryType->delete();

        return response()->json([
                                    'message' => 'Industry Type Deleted Successfully!!'
                                ]);
    }
}
