<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndustryTypeRequest;
use App\Models\ContactType;

class ContactTypeController extends Controller
{
    /**
     * Display a listing of the contact types.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contactTypes = ContactType::all();

        return response()->json($contactTypes);
    }

    /**
     * Store a newly created contact type in storage.
     *
     * @param  App\Http\Requests\IndustryTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(IndustryTypeRequest $request)
    {
        $contactType = ContactType::create($request->post());

        return response()->json([
                                    'message'      => 'Contact Type Created Successfully!!',
                                    'contact_type' => $contactType
                                ]);
    }

    /**
     * Display the specified contact type.
     *
     * @param  \App\Models\ContactType  $contactType
     * @return \Illuminate\Http\Response
     */
    public function show(ContactType $contactType)
    {
        return response()->json($contactType);
    }

    /**
     * Update the specified contact type in storage.
     *
     * @param  App\Http\Requests\IndustryTypeRequest  $request
     * @param  \App\Models\ContactType  $contactType
     * @return \Illuminate\Http\Response
     */
    public function update(IndustryTypeRequest $request, ContactType $contactType)
    {
        $contactType->fill($request->post())->save();

        return response()->json([
                                    'message'      => 'Contact Type Updated Successfully!!',
                                    'contact_type' => $contactType
                                ]);
    }

    /**
     * Remove the specified contact type from storage.
     *
     * @param  \App\Models\ContactType  $contactType
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContactType $contactType)
    {
        $contactType->delete();

        return response()->json([
                                    'message' => 'Contact Type Deleted Successfully!!'
                                ]);
    }
}
