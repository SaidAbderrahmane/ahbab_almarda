<?php

namespace App\Http\Controllers;

use App\Models\Lieu;
use Illuminate\Http\Request;

class LieuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Lieu::query();

        if (request()->order) {
            $orderBy = explode('-', request()->order)[0];
            $orderHow = explode('-', request()->order)[1];
        } else {
            $orderBy = "nom_lieu";
            $orderHow = "asc";
        }
        $query->orderBy($orderBy, $orderHow);

        //search
        if (request()->q) {
            $q = request()->q;
            $query->where('nom_lieu', 'like', "%$q%");
        }

        $locations = $query->get();
        return view('pages.locations.locations', ['locations' => $locations]);
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
        $request->validate(
            [
                'nom_lieu' => 'required',
            ]
        );
        Lieu::create(
            [
                'nom_lieu' => $request->input('nom_lieu'),
            ]
        );

        return redirect()->back()->with('success', 'Location created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Lieu $lieu)
    {
        //
    }

    public function getLocationById($id)
    {
        $location = Lieu::find($id);
        return response()->json(['data' => $location]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lieu $lieu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'key_lieu' => 'required',
            'nom_lieu' => 'required'
        ]);

        $location = Lieu::find($id);
        $location->update(
            [
                'key_lieu' => $request->input('key_lieu'),
                'nom_lieu' => $request->input('nom_lieu'),
            ]
        );

        return redirect()->back()->with('success', 'Location updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Lieu::destroy($id);
        return redirect()->back()->with('success', 'Location deleted successfully!');
    }
}