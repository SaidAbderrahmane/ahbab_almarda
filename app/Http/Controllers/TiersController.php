<?php

namespace App\Http\Controllers;

use App\Models\Agherme;
use App\Models\Tiers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class TiersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $donors = Tiers::all()->toQuery()->where('sexe', '=', 'F')->paginate(30);
        $aghermes = Agherme::all();
        return view('pages.donors.donors', ['donors' => $donors, 'aghermes'=>$aghermes]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'nom_prenom' => 'required',
                'pere' => 'required',
                'grand_pere' => 'required',
                'groupage' => 'required',
                'adresse' => 'required',
                'date_naissance' => 'required',
                'key_agherme' => 'required',
                'sexe' => 'required',
            ]
        );
        Tiers::create(
            [
                'nom_prenom' => $request->input('nom_prenom'),
                'pere' => $request->input('pere'),
                'grand_pere' => $request->input('grand_pere'),
                'groupage' => $request->input('groupage'),
                'adresse' => $request->input('adresse'),
                'date_naissance' =>date('Y-m-d', strtotime($request->input('date_naissance'))),
                'key_agherme' => $request->input('key_agherme'),
                'code_barres' => $request->input('code_barres'),
                'sexe' => $request->input('sexe'),
                'key_tiers_type' => 2,
                'key_quartier' => 3
            ]
        );

        return redirect()->back()->with('success', 'Donor created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tiers $tiers)
    {
        //
    }

    public function getDonorById($id)
    {
        $donor = Tiers::find($id);
        return response()->json(['data' => $donor]);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tiers $tiers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'key_tiers' => 'key_tiers',
            'nom_prenom' => 'required',
            'pere' => 'required',
            'grand_pere' => 'required',
            'groupage' => ['required', Rule::in(Config::get('constants.blood_types'))],
            'adresse' => 'required',
            'date_naissance' => 'required',
            'key_agherme' => 'required',
            'key_quartier' => 'required',
            'code_barres' => 'required',
            'sexe' => 'required',
        ]);

        $donor = Tiers::find($id);
        $donor->update(
            [
                'key_tiers' => $request->input('key_tiers'),
                'nom_prenom' => $request->input('nom_prenom'),
                'pere' => $request->input('pere'),
                'grand_pere' => $request->input('grand_pere'),
                'groupage' => $request->input('groupage'),
                'adresse' => $request->input('adresse'),
                'date_naissance' => $request->input('date_naissance'),
                'key_agherme' => $request->input('key_agherme'),
                'key_quartier' => $request->input('key_quartier'),
                'code_barres' => $request->input('code_barres'),
                'sexe' => $request->input('sexe'),
                'key_tiers_type' => 2
            ]
        );

        return redirect()->back()->with('success', 'Donor updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Tiers::destroy($id);
        return redirect()->back()->with('success', 'Donor deleted successfully!');

    }
}