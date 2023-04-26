<?php

namespace App\Http\Controllers;

use App\Models\Agherme;
use Illuminate\Http\Request;

class AghermeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $aghermes = Agherme::all();
        return view('pages.aghermes.aghermes', ['aghermes' => $aghermes]);
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
            'agherme' => 'required'
        ]);

        Agherme::create(
            [
                'agherme' => $request->input('agherme'),
            ]
        );

        return redirect()->back()->with('success', 'Agherme created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Agherme $agherme)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Agherme $agherme)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'key_agherme' => 'required',
            'agherme' => 'required'
        ]);

        $agherme = Agherme::find($id);
        $agherme->update(
            [
                'key_agherme' => $request->input('key_agherme'),
                'agherme' => $request->input('agherme'),
            ]
        );

        return redirect()->back()->with('success', 'Agherme updated successfully!');
    }

    public function getAghermeById($id)
    {
        $agherme = Agherme::find($id);
        return response()->json(['data' => $agherme]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Agherme::destroy($id);
        return redirect()->back()->with('success', 'Agherme deleted successfully!');
    }
}