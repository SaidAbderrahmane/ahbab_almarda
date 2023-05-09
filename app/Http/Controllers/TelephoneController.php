<?php

namespace App\Http\Controllers;

use App\Models\Telephone;
use Illuminate\Http\Request;

class TelephoneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }
    public function getContacts($id)
    {
        $contacts = Telephone::all()->where('key_tiers',$id);
        return response()->json(['data' => $contacts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'key_tiers' => 'required',
            'tel_email' => 'required',
            'type_tel' => 'required',
            'personnel_autre' => 'required',
        ]);

        Telephone::create(
            [
                'key_tiers' => $request->input('key_tiers'),
                'tel_email' => $request->input('tel_email'),
                'type_tel' => $request->input('type_tel'),
                'personnel_autre' => $request->input('personnel_autre'),
                'proprietaire' => $request->input('proprietaire'),
            ]
        );

        return  ['success' => true, 'message' => 'Contact added successfully!'];
    }

    /**
     * Display the specified resource.
     */
    public function show(Telephone $telephone)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Telephone $telephone)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'tel_email' => ['required', 'string'],
            'type_tel' => ['required', 'string'],
            'personnel_autre' => ['required', 'string'],
        ]);
        $tel = Telephone::find($id);
        $tel->update(
            [
                'key_tel' => $id,
                'tel_email' => $request->input('tel_email'),
                'type_tel' => $request->input('type_tel'),
                'personnel_autre' => $request->input('personnel_autre'),
                'proprietaire' => $request->input('proprietaire'),
            ]
        );
        return ['success' => true, 'message' => 'Contact updated successfully!'];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Telephone::destroy($id);
        return ['success' => true, 'message' => 'Contact deleted successfully!'];
    }
}