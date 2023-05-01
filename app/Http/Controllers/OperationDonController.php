<?php

namespace App\Http\Controllers;

use App\Models\DetailOperation;
use App\Models\Lieu;
use App\Models\OperationDon;
use App\Models\Tiers;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OperationDonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $compaigns = OperationDon::all()->toQuery()->orderBy("num_operation")->paginate(30);
        $locations = Lieu::all();
        return view('pages.compaigns.compaigns', ['compaigns' => $compaigns, 'locations' => $locations]);
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
        try {
            $request->validate(
                [
                    'nom_operation' => 'required',
                    'num_operation' => 'required',
                    'date_operation' => 'required',
                    'key_lieu' => 'required',
                    'genre' => ['required', Rule::in(['H', 'F'])],
                    'hopital' => 'required',
                ]
            );
            OperationDon::create(
                [
                    'nom_operation' => $request->input('nom_operation'),
                    'num_operation' => $request->input('num_operation'),
                    'date_operation' => date('Y-m-d', strtotime($request->input('date_operation'))),
                    'key_lieu' => $request->input('key_lieu'),
                    'genre' => $request->input('genre'),
                    'hopital' => $request->input('hopital'),
                ]
            );
        } catch (QueryException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }


        return redirect()->back()->with('success', 'Compaign created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $compaign = OperationDon::all()->firstWhere("key_operation", "=", $id);
        $compaign_detail = DetailOperation::where('key_operation', $id)->paginate();
        $donors = Tiers::all()->toQuery()->paginate(30);
        $response = ['compaign' => $compaign, 'compaign_detail' => $compaign_detail, 'donors' => $donors];

        return view('pages.compaign-detail.compaign-detail', $response);
    }

    public function getCompaignById($id)
    {
        $compaign = OperationDon::find($id);
        return response()->json(['data' => $compaign]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OperationDon $operationDon)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'nom_operation' => 'required',
                'num_operation' => 'required',
                'date_operation' => 'required',
                'key_lieu' => 'required',
                'genre' => ['required', Rule::in(['H', 'F'])],
                'hopital' => 'required',
            ]
        );
        $compaign = OperationDon::find($id);
        $compaign->update(
            [
                'nom_operation' => $request->input('nom_operation'),
                'num_operation' => $request->input('num_operation'),
                'date_operation' => date('Y-m-d', strtotime($request->input('date_operation'))),
                'key_lieu' => $request->input('key_lieu'),
                'genre' => $request->input('genre'),
                'hopital' => $request->input('hopital'),
            ]
        );

        return redirect()->back()->with('success', 'Compaign updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        OperationDon::destroy($id);
        return redirect()->back()->with('success', 'Compaign deleted successfully!');
    }
}