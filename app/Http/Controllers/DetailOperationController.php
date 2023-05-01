<?php

namespace App\Http\Controllers;

use App\Models\DetailOperation;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DetailOperationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
                    'key_tiers' => 'required',
                    'key_operation' => 'required',
                ]
            );
            DetailOperation::create(
                [
                    'key_tiers' => $request->input('key_tiers'),
                    'key_operation' => $request->input('key_operation'),
                    'observation' => $request->input('observation'),
                    'par_viber' => $request->input('par_viber') ?? 'N',
                    'par_sms' => $request->input('par_sms') ?? 'N',
                    'par_annonce' => $request->input('par_annonce') ?? 'N',
                    'par_facebook' => $request->input('par_facebook') ?? 'N',
                    'accepte' => $request->input('accepte') ?? 'N',
                    'matricule' => $request->input('matricule'),
                ]
            );
        } catch (QueryException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }


        return redirect()->back()->with('success', 'donor line added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(DetailOperation $detailOperation)
    {
        //
    }

    public function getCompaignDetailsById($id)
    {
        $compaign_details = DetailOperation::find($id);
        $compaign_details['nom_prenom'] = $compaign_details->donneur->nom_prenom;
        $compaign_details['pere'] = $compaign_details->donneur->pere;
        return response()->json(['data' => $compaign_details]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DetailOperation $detailOperation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $request->validate(
                [
                    'key_tiers' => 'required',
                    'key_operation' => 'required',
                ]
            );
            $compaign_details = DetailOperation::find($id);
            $compaign_details->update(
                [
                    'key_tiers' => $request->input('key_tiers'),
                    'key_operation' => $request->input('key_operation'),
                    'observation' => $request->input('observation'),
                    'par_viber' => $request->input('par_viber')== true ? 'O' : 'N',
                    'par_sms' => $request->input('par_sms') == true ? 'O' : 'N',
                    'par_annonce' => $request->input('par_annonce')== true ? 'O' : 'N',
                    'par_facebook' => $request->input('par_facebook')== true ? 'O' : 'N',
                    'accepte' => $request->input('accepte')== true ? 'O' : 'N',
                    'matricule' => $request->input('matricule'),
                ]
            );
        } catch (QueryException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
        return redirect()->back()->with('success', 'donor line updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DetailOperation::destroy($id);
        return redirect()->back()->with('success', 'donor line deleted successfully');
    }
}