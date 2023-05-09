<?php

namespace App\Http\Controllers;

use App\Models\Agherme;
use App\Models\Tiers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class TiersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $donors = Tiers::all()->toQuery()->paginate(30);
        $aghermes = Agherme::all();
        return view('pages.donors.donors', ['donors' => $donors, 'aghermes' => $aghermes]);

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
                'nom_prenom' => strtoupper($request->input('nom_prenom')),
                'pere' => strtoupper($request->input('pere')),
                'grand_pere' => strtoupper($request->input('grand_pere')),
                'groupage' => $request->input('groupage'),
                'adresse' => $request->input('adresse'),
                'date_naissance' => date('Y-m-d', strtotime($request->input('date_naissance'))),
                'key_agherme' => $request->input('key_agherme'),
                'code_barres' => $request->input('code_barres'),
                'sexe' => $request->input('sexe'),
                'key_tiers_type' => 2,
                'key_quartier' => 3
            ]
        );

        return redirect()->back()->with('success', 'Donor created successfully');
    }

    public function store_api(Request $request)
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
        $id = Tiers::create(
            [
                'nom_prenom' => strtoupper($request->input('nom_prenom')),
                'pere' => strtoupper($request->input('pere')),
                'grand_pere' => strtoupper($request->input('grand_pere')),
                'groupage' => $request->input('groupage'),
                'adresse' => $request->input('adresse'),
                'date_naissance' => date('Y-m-d', strtotime($request->input('date_naissance'))),
                'key_agherme' => $request->input('key_agherme'),
                'code_barres' => $request->input('code_barres'),
                'sexe' => $request->input('sexe'),
                'key_tiers_type' => 2,
                'key_quartier' => 3
            ]
        );

        return ['success' => true, 'message' => 'Donor created successfully','donor'=>$id];
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
        $donor = Tiers::with('contacts')->where('key_tiers', $id)->first();
        return response()->json(['data' => $donor]);
    }

    public function getDonors(Request $request)
    {
        $q = $request['q'];
        if ($q) {
            if (count(explode('/', $q)) > 1) {
                $person = explode('/', $q)[0];
                $father = explode('/', $q)[1];
                $donors = Tiers::all()->toQuery()->where('nom_prenom', 'like', "%$person%")->orWhere('pere', 'like', "%$father%")
                    ->orWhere('code_barres', 'like', "%$q%")->paginate(30);
            } else {
                $donors = Tiers::all()->toQuery()->where('nom_prenom', 'like', "%$q%")
                    ->orWhere('code_barres', 'like', "%$q%")->paginate(30);
            }

        } else {
            $donors = Tiers::all()->sortBy('nom_prenom')->toQuery()->paginate(30);
        }
        /*  $utf8Donors = collect([]);
        foreach ($donors as $donor) {
        $encoded = json_encode($donor);
        if (!Str::isJson($encoded)) {
        Log::warning('Non-UTF-8 donor:', $donor->toArray());
        } else {
        $utf8Donors->push($donor);
        }
        } */
        return response()->json($donors);
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
            'nom_prenom' => 'required',
            'pere' => 'required',
            'grand_pere' => 'required',
            'groupage' => ['required', Rule::in(Config::get('constants.blood_types'))],
            'adresse' => 'required',
            'date_naissance' => 'required',
            'key_agherme' => 'required',
            'sexe' => ['required', Rule::in(['H', 'F'])],
        ]);

        $donor = Tiers::find($id);
        $donor->update(
            [
                'key_tiers' => $request->input('key_tiers'),
                'nom_prenom' => strtoupper($request->input('nom_prenom')),
                'pere' => strtoupper($request->input('pere')),
                'grand_pere' => strtoupper($request->input('grand_pere')),
                'groupage' => $request->input('groupage'),
                'adresse' => $request->input('adresse'),
                'date_naissance' => date('Y-m-d', strtotime($request->input('date_naissance'))),
                'key_agherme' => $request->input('key_agherme'),
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